<?php
 
namespace Application\Controllers;

class Admin extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelRecette;
	private $modelCategorie;
	private $modelIngredient;
	private $modelShowDiv;
	private $modelAjax;


	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelRecette 		= new \Application\Models\Recette('localhost');
		$this->modelVR 				= new \Application\Models\ViewRecette('localhost');
		$this->modelShowDiv 		= new \Application\Models\ShowDiv();
		$this->modelAjax 			= new \Application\Models\Ajax();
	}


	public function indexAction(){
		if($_SESSION['user']['role'] !== "admin"){
			$this->setRedirect(LINK_ROOT);
		}
		//echo "<br><br><br><br><br><br><br><br><br><br>";
		$viewRs = $this->modelVR->getAllViewRecettes();
		//var_dump("vue",$viewRs);
		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $viewRs['response']
		));
	}


	public function creerRecetteAction(){
			//echo '<br><br><br><br><br><br>';

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


			$slugTitre = str_replace( ' ','-', $this->retirerCaractereSpeciaux($_POST["titre"]) );
			$_POST["slugtitre"] = strtolower($slugTitre);


  			$_POST["diabete"]	=	(isset($_POST["diabete"])? 1:0);
			$_POST["ble"]		=	(isset($_POST["ble"])?1:0);
			$_POST["lait"]		=	(isset($_POST["lait"])?1:0);
			$_POST["oeuf"]		=	(isset($_POST["oeuf"])?1:0);
			$_POST["arachide"]	=	(isset($_POST["arachide"])?1:0);
			$_POST["soja"]		=	(isset($_POST["soja"])?1:0);
			$_POST["gluten"]	=	(isset($_POST["gluten"])?1:0);



			$ingreds=$_POST["ingredients"];		unset($_POST["ingredients"]);
			$unites=$_POST["unites"];			unset($_POST["unites"]);

			$quantites=$_POST["quantites"];			unset($_POST["quantites"]);
			


			$modelRecette 	= new \Application\Models\Recette('localhost');
			$res = $modelRecette->insertRecette($_POST,  $_SESSION['user']['id_user']);

			$res = $res['response'];

	        if(!empty($_FILES['img'])){
		        $root = $_FILES['img']['tmp_name'];

		        $type = $this->getImageExtension($_FILES['img']['type']);

		        if ($type === "erreur") {
		        	$this->message->addError("Le format de l'image n'est pas correct (jpeg, png, tiff), l'image n'a pas été envoyée");
		        } else {
			        $img = IMG_ROOT.'recette/'. $slugTitre.".$type";

			        if(copy($root, $img )){
			        	$_POST['img'] = 'recette/'.  $slugTitre.".$type";
			        }else{
			        	unset($_POST['img']);
			        	$this->message->addError("Pb avec la mise a jour de l'image");
			        }
		        }
		        
			}
	        $modelRecette->updateRecette($_POST, $res);
			
			if ($res > 0 ) {
				
				
				
				$modelListIngredients 	= new \Application\Models\ListIngredients('localhost');


				$res =$modelListIngredients->insertListIngredients($ingreds, $unites , $res, $quantites );
				
					//aucune verif la flemme
				if($res['response']){
					$this->message->addSuccess("Recette ajoutée");
				}else{
					$this->message->addSuccess("Recette ajoutée sans les ingredients");
				}



			}else{
				$this->message->addError($res['apiErrorMessage']);
				$this->message->addError($res['serverErrorMessage']);
			}
			
		}

		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();
		$cat=$cat['response'];

		$this->setDataView(array("categories" =>  $cat));




		//recherche des ingredients
		$modelIngredient 	= new \Application\Models\Ingredient('localhost');
		$ing=$modelIngredient->getIngredients();


		$ing=$ing['response'];


		//$ing=$modelIngredient->convEnTab($ing);


		$this->setDataView(array("ingredients" =>  $ing));



		//recherche des Unites
		$modelUnite 	= new \Application\Models\Unite('localhost');
		$unit=$modelUnite->getUnites();

		$unit=$unit['response'];
		//$unit=$modelUnite->convEnTab($unit);

		$this->setDataView(array(
			"unites" =>  $unit, 
			"message" => $this->message->showMessages()
			));




		

		$this->setScriptView("adminrecettes.js");




	}

	
	/**
	 * [mettreAJourRecetteAction : l'addresse fini avec un parametre get : ]
	 * 							http://localhost/chefdesfourneaux/admin/mettreajourrecette/12
	 * @return [type] [description]
	 */
	public function mettreAJourRecetteAction($idRecette){

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

			$slugTitre = str_replace( ' ','-', $this->retirerCaractereSpeciaux($_POST["titre"]) );
			$_POST["slugtitre"] = strtolower($slugTitre);


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

				echo "<br><br><br><br><br><br><br><br><br><br>";
			var_dump($_FILES['img']);
			//######################## Copie et met a jour dans la base
	        if(!empty($_FILES['img'])){
		        $root = $_FILES['img']['tmp_name'];

		        $type = $this->getImageExtension($_FILES['img']['type']);
				var_dump($_FILES['img'],$type);

		        if ($type === "erreur") {
		        	$this->message->addError("Le format de l'image n'est pas correct (jpeg, png, tiff), l'image n'a pas été envoyée");
		        } else {
		        	

			        //$img = IMG_ROOT. preg_replace('/\s\s+/','-', $this->retirerCaractereSpeciaux($_POST["titre"]).".$type");
			        $img = IMG_ROOT.'recette/'. $slugTitre.'.$type';
			        echo $img."<=======================";
			        	// var_dump($root, $img);
			        if(copy($root, $img )){
			        	$_POST['img'] = 'recette/'.  $slugTitre.".$type";
			        }else{
			        	unset($_POST['img']);
			        	$this->message->addError("Problème avec la mise a jour de l'image");
			        }
		        }
		        

			}
			
			$res =$modelRecette->updateRecette($_POST, $idRecette ) ;

			
			//$res=$res['response'];

			if ($res['response']){			//res est un bool
				
				$modelListIngredients 	= new \Application\Models\ListIngredients('localhost');
				//echo "<br><br><br><br>";
				//var_dump("ing",$ingreds, $unites , $idRecette, $quantites );
				$res = $modelListIngredients->updateListIngredients($ingreds, $unites , $idRecette, $quantites ) ;

				if($res['response']){
					$this->message->addSuccess("Recette modifiée");
				}else{
					$this->message->addSuccess("Recette modifiée sans les ingredients");
				}



			}else{
				$this->message->addError($res['apiErrorMessage']);
				$this->message->addError($res['serverErrorMessage']);
			}
		}


		



		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();
		$cat=$cat['response'];


		//recherche des ingredients
		$modelIngredient 	= new \Application\Models\Ingredient('localhost');
		$ings=$modelIngredient->getIngredients();
		$ings=$ings['response'];
		

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
		$unit=$unit['response'];
		




		if( $idRecette>0 ){		//condition qui  sert a rien
			
			//## prepare les données pour afficher la recette
			
			$modelVR 	= new \Application\Models\ViewRecette('localhost');
			$viewR 		= $modelVR->getViewRecette($idRecette);
			$viewR 		= $viewR['response'];
		}











		//script ajax permettant d'ajouter un ingredient a la bdd puis de le prendre en compte
		/*$successfonc="
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
			val = data['response'];		//test à faire : si >0 ==> insertion faite
			label=document.getElementById('DivContainerCategorieValue').value;
			$('#id_cat').append('<option value=\"'+val+'\" selected>'+label+'</option>');
			

			alert('categorie ajoutée');
		";
		$scriptAjax = $this->modelAjax->getAjaxPost(array("value"=>"DivContainerCategorieValue"),"categorie", "insertcategorie", array(), "ajouterCategorieBdd", $successfonc);

		$viewButtonShowDivCategorie = $this->modelShowDiv->getHtmlButtonShowDiv(	"ajouterCategorieBdd", "Ajouter une catégorie");

		$viewShowDivScript = $this->modelShowDiv->getScriptShowDiv("DivContainerCategorie",	"ajouterCategorieBdd", $scriptAjax, "ajouterCategorieBdd");

		$viewShowDivHtml = $this->modelShowDiv->getHtmlShowDiv("DivContainerCategorie", "d'une catégorie", "Catégorie", "cette catégorie");

		$codeAjaxCategorie=$viewShowDivHtml."".$viewShowDivScript;*/
		
		
		$this->setDataView(array(
			"message" => $this->message->showMessages(),
			"categories" =>  $cat,
			"ingredients" =>  $ings,
			"unites" =>  $unit,
			"viewrecette" =>  $viewR
			/*"ajaxIngredientButton" => $viewButtonShowDivIngredient,
			"ajaxIngredientScript" =>	$codeAjaxIngredient,
			"ajaxCategorieButton" => $viewButtonShowDivCategorie,
			"ajaxCategorieScript" =>	$codeAjaxCategorie*/
		));


		//ajoute la declaration de la variable idRecette au js (exemple : jsIdRecette=1)
		$this->setJsConfigAvant("variable", "IdRecette", $viewR['id_recette'] );

		//ajoute le code qui  lance une fonction ... avec comme parametre la variable créée ci dessus
		//$this->setJsConfig("code" , "actualiserImageFormRecette( jsIdRecette );", "" );
		$this->setJsConfigApres("code" , "actualiserImageFormRecette( jsIdRecette );" );

		$this->setScriptView("adminrecettes.js");


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


	public function logoutAction(){
		session_unset();
	}






	public function gestionAction(){

		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}



		if(isset($_POST['btn'])){
			
			
			if(empty($_POST['value'])){
				$this->message->addError("Recette vide !");
			}

			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message"=> $this->message->showMessages()) );

				return false;
			}

			unset($_POST['btn'], $listMessage);











		}	//fin if(btn)


		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();
		$cat=$cat['response'];
		//$cat=$modelCategorie->convEnTab($cat);


		//recherche des ingredients
		$modelIngredient 	= new \Application\Models\Ingredient('localhost');
		$ings=$modelIngredient->getIngredients();
		$ings=$ings->response;
		$ings=$modelIngredient->convEnTab($ings);

		//recherche des Unites
		$modelUnite 	= new \Application\Models\Unite('localhost');
		$unit=$modelUnite->getUnites();
		$unit=$unit->response;
		$unit=$modelUnite->convEnTab($unit);



		$this->setDataView(array(
			"pageTitle" => "Gestion des categories, des ingrédients et des unités",
			"message" => $this->message->showMessages(),
			"categories"			=>  $cat,
			"ingredients" 			=>  $ings,
			"unites" 				=>  $unit
		));

		


	}

}