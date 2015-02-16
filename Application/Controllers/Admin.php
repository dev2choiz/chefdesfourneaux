<?php

namespace Application\Controllers;

class Admin extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;

	public function __construct(){
		parent::__construct();
		//$this->setLayout("carousel");
		$this->setLayout("blog");
		$this->message = new \Library\Message\Message();
		$this->tinyMCE=new \Library\TinyMCE\tinyMCE();
	}


	public function indexAction(){
		
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



			$ingreds=$_POST["ingredients"];		unset($_POST["ingredients"]);
			$unites=$_POST["unites"];			unset($_POST["unites"]);

			$modelRecette 	= new \Application\Models\Recette('localhost');
			$res =$modelRecette->insertRecette($_POST,  $_SESSION['user']['id_user']);
			//echo $res;
			var_dump($res,$_POST);die();
			$res=get_object_vars(json_decode($res)) ;
			$res=$res['response'];
			
			if ($res > 0 ) {
				//header('location: '.LINK_ROOT.'recette');
				//die();
				
				
				
				$modelListeIngredient 	= new \Application\Models\ListeIngredient('localhost');
				var_dump($_POST);
				$res =$modelListeIngredient->insertListeIngredients($ingreds, $unites , $res );
				
				var_dump($res,'dgjk');


			}else{
				$this->message->addError($user->apiErrorMessage);
				$this->message->addError($user->serverErrorMessage.$res);
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





	}

	public function mettreajourRecetteAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function supprimerRecetteAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function creerLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function mettreajourLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function supprimerRestaurantAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function creerLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function creerLivreAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function supprimerRestaurantAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}


	public function logoutAction(){
		session_unset();
	}
}