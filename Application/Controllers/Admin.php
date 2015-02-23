<?php

namespace Application\Controllers;

class Admin extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelRecette;
	private $modelCategorie; // A compléter
	private $modelIngredient; // A compléter


	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 		= new \Library\Message\Message();
		$this->tinyMCE 		= new \Library\TinyMCE\tinyMCE();
		$this->modelRecette = new \Application\Models\Recette('localhost');
	}


	public function indexAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
		$recettes = $this->modelRecette->getRecettes();

		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $recettes->response
		));
	}


	public function creerRecetteAction(){
		

		//echo "creer    ".LINK_ROOT."recette/creer";
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
		
		$this->setDataView(array(
			"pageTitle" => "Créer une recette",
			"tinyMCE" => $this->tinyMCE->getSource()
		));

		
		if(isset($_POST['btn'])){
			
			
			if(empty($_POST['value'])){
				$this->message->addError("Recette vide !");
			}

			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));

				return false;
			}

			unset($_POST['btn'], $listMessage);



  			$_POST["diabete"]	=	(isset($_POST["diabete"])? 1:0);
			$_POST["ble"]		=	(isset($_POST["ble"])?1:0);
			$_POST["lait"]		=	(isset($_POST["lait"])?1:0);
			$_POST["oeuf"]		=	(isset($_POST["oeuf"])?1:0);
			$_POST["arachide"]	=	(isset($_POST["arachide"])?1:0);
			$_POST["soja"]		=	(isset($_POST["soja"])?1:0);
			$_POST["gluten"]	=	(isset($_POST["gluten"])?1:0);


			//$_POST["cout"]	=	$_POST["cout"]+0;
			
			//var_dump($_POST);




			$ingreds=$_POST["ingredients"];		unset($_POST["ingredients"]);
			$unites=$_POST["unites"];			unset($_POST["unites"]);

			$quantites=$_POST["quantites"];			unset($_POST["quantites"]);
			

			//var_dump("dff",$_POST);
			$modelRecette 	= new \Application\Models\Recette('localhost');
			
			$res =$modelRecette->insertRecette($_POST,  $_SESSION['user']['id_user']);
			
			
			$res=get_object_vars(json_decode($res));
			$res=$res['response'];
			
			if ($res > 0 ) {
				//header('location: '.LINK_ROOT.'recette');
				//die();
				
				
				
				$modelListeIngredients 	= new \Application\Models\ListeIngredients('localhost');
				
				$res =$modelListeIngredients->insertListeIngredients($ingreds, $unites , $res, $quantites );
				
				

				$this->message->addSuccess("Recette ajoutée");




			}else{
				$this->message->addError($user->apiErrorMessage);
				$this->message->addError($user->serverErrorMessage);
			}
		}


		//données pour la view
		//
		$this->setDataView(array("message" => $this->message->showMessages()));

		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();

		
		$cat=$cat->response;
		
		

		$cat=$modelCategorie->convEnTab($cat);

		$this->setDataView(array("categories" =>  $cat));




		//recherche des ingredients
		$modelIngredient 	= new \Application\Models\Ingredient('localhost');
		$ing=$modelIngredient->getIngredients();


		$ing=$ing->response;


		$ing=$modelIngredient->convEnTab($ing);


		$this->setDataView(array("ingredients" =>  $ing));



		//recherche des Unites
		$modelUnite 	= new \Application\Models\Unite('localhost');
		$unit=$modelUnite->getUnites();

		$unit=$unit->response;
		$unit=$modelUnite->convEnTab($unit);

		$this->setDataView(array("unites" =>  $unit));











	}

	public function mettreajourRecetteAction($id){

		
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
		
		$this->setDataView(array(
			"pageTitle" => "Modifier une recette",
			"tinyMCE" => $this->tinyMCE->getSource()
		));
/*		
		if(isset($_POST['btn'])){
			
			
			if(empty($_POST['value'])){
				$this->message->addError("Recette vide !");
			}

			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));

				return false;
			}

			unset($_POST['btn'], $listMessage);



			$ingreds=$_POST["ingredients"];		unset($_POST["ingredients"]);
			$unites=$_POST["unites"];			unset($_POST["unites"]);

			$quantites=$_POST["quantites"];			unset($_POST["quantites"]);
			


			$modelRecette 	= new \Application\Models\Recette('localhost');
			$res =$modelRecette->insertRecette($_POST,  $_SESSION['user']['id_user']);
			
			
			$res=get_object_vars(json_decode($res));
			$res=$res['response'];
			
			if ($res > 0 ) {
				//header('location: '.LINK_ROOT.'recette');
				//die();
				
				
				
				$modelListeIngredients 	= new \Application\Models\ListeIngredients('localhost');
				
				$res =$modelListeIngredients->insertListeIngredients($ingreds, $unites , $res, $quantites );
				
				






			}else{
				$this->message->addError($user->apiErrorMessage);
				$this->message->addError($user->serverErrorMessage.$res);
			}
		}





*/

		//################## données pour la view ############################



		//données pour la view


		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();
		$cat=$cat->response;
		$cat=$modelCategorie->convEnTab($cat);


		//recherche des ingredients
		$modelIngredient 	= new \Application\Models\Ingredient('localhost');
		$ing=$modelIngredient->getIngredients();
		$ing=$ing->response;
		$ing=$modelIngredient->convEnTab($ing);


		//recherche des Unites
		$modelUnite 	= new \Application\Models\Unite('localhost');
		$unit=$modelUnite->getUnites();
		$unit=$unit->response;
		$unit=$modelUnite->convEnTab($unit);


		//if(isset($_GET['page'])){		
			//## prepare les données pour afficher la recette

		
			$modelVR 	= new \Application\Models\ViewRecette('localhost');
			$viewR 		= $modelVR->getViewRecette($id);
			$viewR 		= $viewR['response'][0];
			var_dump($viewR);

			$this->setDataView(array(
				"message" => $this->message->showMessages(),
				"viewrecette" =>  $viewR,
				"categories" =>  $cat,
				"ingredients" =>  $ing,
				"unites" =>  $unit
			));

		


	}

	public function supprimerRecetteAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}

	public function creerLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}

	public function mettreajourLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}

	public function supprimerLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}

	public function creerRestaurantAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}

	public function mettreajourRestaurantAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}

	public function supprimerRestaurantAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
	}


	public function logoutAction(){
		session_unset();
	}
}