<?php
 
namespace Application\Controllers;

class AdminProduit extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelProduits;
	private $modelViewProduit; 
	private $modelPopUpProduit;
	private $modelPanier;
	private $modelShowDiv;
	private $modelAjax;


	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();

		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelProduits 		= new \Application\Models\Produit('localhost');
		$this->modelViewProduit 	= new \Application\Models\ViewProduit('localhost');
		$this->modelPanier			= new \Application\Models\Panier('localhost');
		$this->modelPopUpProduit	= new \Application\Models\PopUpProduit();
		$this->modelShowDiv 		= new \Application\Models\ShowDiv();
		$this->modelAjax 			= new \Application\Models\Ajax();
	}


	public function indexAction(){
		echo "<BR><BR><BR>";


		if( !$this->isConnected() || $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}
	

		$produits = $this->modelProduits->getAllProduits();
		$produits = $produits['response'];
		

		

		// Ajoute les infos du produits au html
		foreach ($produits as $key => $produit) {

			$produits[$key]['modifierpopup']=$this->modelPopUpProduit->getModifPopup(
																$produit['id_produit'], 
																$produit['prix'], 
																$produit['ref'],
																$produit['value']);


			/* if(!empty($_SESSION['user'])){
				$tst=$this->modelPanier->existeDansPanier($_SESSION['user']['id_user'], $produit['id_produit']);
			} */
			
			/*$produits[$key]['acheterpopup']=$this->modelPopUpProduit->getAcheterPopup(
															$produit['id_produit'], 
															$produit['prix'], 
															$produit['ref'],
															$produit['value']);*/

		}
		
		
		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits
			)
		);

		$this->setStyleView('popup.css');

		$this->setScriptView('produit.js');





	
	}


	/*public function creerRecetteAction(){
		

		//echo "creer    ".LINK_ROOT."recette/creer";
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
		
		$this->setDataView(array(
			"pageTitle" => "Créer une recette",
			"tinyMCERecette" => $this->tinyMCE->getEditeurRecette()
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
			
			if ($res > 0 ) {		//res= id de la recette créée si tout s est bien passé
				//header('location: '.LINK_ROOT.'recette');
				//die();
				
				
				
				$modelListIngredients 	= new \Application\Models\ListIngredients('localhost');
				//echo "<br><br><br><br>";
				//var_dump($ingreds, $unites , $res, $quantites );
				$res =$modelListIngredients->insertListIngredients($ingreds, $unites , $res, $quantites );
				//echo $res->page;
				//var_dump("ress",$res);
				
					//aucune verif la flemme
				if($res->response){
					$this->message->addSuccess("Recette ajoutée");
				}else{
					$this->message->addSuccess("Recette ajoutée sans les ingredients");
				}



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

	
	/**
	 * [mettreAJourRecetteAction : l'addresse fini avec un parametre get : ]
	 * 							http://localhost/fourneaux/admin/mettreajourrecette/12
	 * @return [type] [description]
	 /
	public function mettreAJourRecetteAction($idRecette){

		echo "<br><br><br><br>".$idRecette;
		
		
		
		if( $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}elseif( !isset($idRecette) || empty($idRecette)  || $idRecette===0 ){	//si pas d'idrecette
			$this->setRedirect(LINK_ROOT."admin/");
		}




		$this->setDataView(array(
			"pageTitle" => "Modifier une recette",
			"tinyMCERecette" => $this->tinyMCE->getEditeurRecette()
		));
		

		// Appuyer sur btn Modifier Recette
		if(isset($_POST['btn'])){
			//var_dump($_POST);

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


			$_POST["cout"]		=	$_POST["cout"]+0;
			

			$ingreds=$_POST["ingredients"];			unset($_POST["ingredients"]);
			$unites=$_POST["unites"];				unset($_POST["unites"]);
			$quantites=$_POST["quantites"];			unset($_POST["quantites"]);
			

			
			$modelRecette 	= new \Application\Models\Recette('localhost');
			
			$res =$modelRecette->convEnTab($modelRecette->updateRecette($_POST, $idRecette ) );
			


			$res=$res['response'];
			
			if ($res){			//res est un bool
				//header('location: '.LINK_ROOT.'recette');
				//die();
				
				
				
				$modelListIngredients 	= new \Application\Models\ListIngredients('localhost');
				//echo "<br><br><br><br>";
				//var_dump("ing",$ingreds, $unites , $idRecette, $quantites );
				$res =$modelListIngredients->convEnTab( $modelListIngredients->updateListIngredients($ingreds, $unites , $idRecette, $quantites ) );

				


				if($res['response']){
					$this->message->addSuccess("Recette midifiée");
				}else{
					$this->message->addSuccess("Recette midifiée sans les ingredients");
				}



			}else{
				$this->message->addError($user->apiErrorMessage);
				$this->message->addError($user->serverErrorMessage);
			}
		}


		



		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();
		$cat=$cat->response;
		$cat=$modelCategorie->convEnTab($cat);


		//recherche des ingredients
		$modelIngredient 	= new \Application\Models\Ingredient('localhost');
		$ings=$modelIngredient->getIngredients();
		$ings=$ings->response;
		$ing=$modelIngredient->convEnTab($ings);

		$ingRecherche = '';

		if(isset($_POST['btnRechercherIng'])){
			
			if(empty($_POST['rechercher'])){
				$this->message->addError("Pas d'ingredients recherché");
			}
			foreach ($ing as $ingr) {
				if(strtolower($_POST['rechercher']) == strtolower($ingr['value'])){
					$ingRecherche = $ingr['value'];
				}else{
					$this->message->addError("Cet ingredient n'existe pas encore");
				}
			}
			
		}


		//recherche des Unites
		$modelUnite 	= new \Application\Models\Unite('localhost');
		$unit=$modelUnite->getUnites();
		$unit=$unit->response;
		$unit=$modelUnite->convEnTab($unit);




		if( $idRecette>0 ){		//condition qui  sert a rien
			
			//## prepare les données pour afficher la recette
			
			$modelVR 	= new \Application\Models\ViewRecette('localhost');
			$viewR 		= $modelVR->getViewRecette($idRecette);
			$viewR 		= $viewR['response'];
			//var_dump($viewR);

		}











		//script ajax permettant d'ajouter un ingredient a la bdd puis de le prendre en compte
		$successfonc="
			console.log(data);
			val=data['response'];		//test à faire : si >0 ==> insertion faite
			label=document.getElementById('DivContainerIngredientValue').value;
			$('#ingredients').append('<option value=\"'+val+'\" selected>'+label+'</option>');
			$('#unites').append('<option value=\"'+val+'\" selected>...</option>');

			//tab
        	tabUnit.push('rien');
        	tabQuant.push(1);

			alert('ingredient ajouté');
		";
		$scriptAjax = $this->modelAjax->getAjaxPost(array("value"=>"DivContainerIngredientValue"),"ingredient", "insertingredients", array(), "ajouterIngredientBdd", $successfonc);

		$viewButtonShowDivIngredient = $this->modelShowDiv->getHtmlButtonShowDiv(	"ajouterIngredientBdd", "Ajouter un ingrédient");

		$viewShowDivScript = $this->modelShowDiv->getScriptShowDiv("DivContainerIngredient",	"ajouterIngredientBdd", $scriptAjax, "ajouterIngredientBdd");

		$viewShowDivHtml = $this->modelShowDiv->getHtmlShowDiv("DivContainerIngredient", "d'un ingrédient", "Ingrédient", "cet ingrédient");

		$codeAjaxIngredient=$viewShowDivHtml."".$viewShowDivScript;




		//script ajax permettant d'ajouter une categorie a la bdd puis de la prendre en compte
		$successfonc="
			console.log(data);
			val=data['response'];		//test à faire : si >0 ==> insertion faite
			label=document.getElementById('DivContainerCategorieValue').value;
			$('#id_cat').append('<option value=\"'+val+'\" selected>'+label+'</option>');
			

			alert('categorie ajoutée');
		";
		$scriptAjax = $this->modelAjax->getAjaxPost(array("value"=>"DivContainerCategorieValue"),"categorie", "insertcategorie", array(), "ajouterCategorieBdd", $successfonc);

		$viewButtonShowDivCategorie = $this->modelShowDiv->getHtmlButtonShowDiv(	"ajouterCategorieBdd", "Ajouter une catégorie");

		$viewShowDivScript = $this->modelShowDiv->getScriptShowDiv("DivContainerCategorie",	"ajouterCategorieBdd", $scriptAjax, "ajouterCategorieBdd");

		$viewShowDivHtml = $this->modelShowDiv->getHtmlShowDiv("DivContainerCategorie", "d'une catégorie", "Catégorie", "cette catégorie");

		$codeAjaxCategorie=$viewShowDivHtml."".$viewShowDivScript;
		
		
		$this->setDataView(array(
			"message" => $this->message->showMessages(),
			"categories" =>  $cat,
			"ingredients" =>  $ing,
			"unites" =>  $unit,
			"viewrecette" =>  $viewR,
			"ajaxIngredientButton" => $viewButtonShowDivIngredient,
			"ajaxIngredientScript" =>	$codeAjaxIngredient,
			"ajaxCategorieButton" => $viewButtonShowDivCategorie,
			"ajaxCategorieScript" =>	$codeAjaxCategorie,																																																//la virgule
			"ingRecherche" => $ingRecherche			//<==????????????????
		));

	}

	public function supprimerRecetteAction($idRecette){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}

		if(isset($_POST['btn'])){

			if($this->modelRecette->deleteRecette($idRecette) ){
				$this->message->addSuccess("Recette supprimée");
				$this->setRedirect(LINK_ROOT."admin/");
			}else {
				$this->message->addError("Erreur pendant la suppression de la recette<br> veuillez rééssayer");
			}

		}

			$this->setDataView(array(
				"pageTitle" => "Supprimer une recette",
				"message" => $this->message->showMessages(),
				"idRecette" =>  $idRecette
			));




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
	}*/


}