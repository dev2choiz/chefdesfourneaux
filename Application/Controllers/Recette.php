<?php

namespace Application\Controllers;

class Recette extends \Library\Controller\Controller{

	private $message;
	private $modelCat;
	private $modelViewRecette;
	private $modelViewCategorie;
	private $tinyMCE;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->tinyMCE				= new \Library\tinyMCE\tinyMCE();
		$this->message 				= new \Library\Message\Message();
		$this->modelCat 			= new \Application\Models\Categorie('localhost');
		$this->modelViewCat 		= new \Application\Models\ViewCategorie('localhost');
		$this->modelViewRecette 	= new \Application\Models\ViewRecette('localhost');
	}
		

	public function indexAction(){
		//$viewAllRecette = $this->modelViewRecette->getAllViewRecettes() ;
		//$viewAllRecette 		= $viewAllRecette['response'];
		$viewAllCats  	= $this->modelCat->getCategories();
		//var_dump($viewAllCats);



		if(empty($viewAllCats)){
			$this->message->addError("aucune recette !");
		}elseif ($viewAllCats['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewAllCats['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}else{
			$viewAllCats=$viewAllCats['response'];
		}

		//var_dump("repérage",$viewAllRecette);


		/*
		echo "<br><br><br><br>".$idRecette;
		
		if( $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}elseif( !isset($idRecette) || empty($idRecette)  || $idRecette===0 ){	//si pas d'idrecette
			$this->setRedirect(LINK_ROOT."admin/");
		}
		*/

		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"tinyMCECommentaire" => $this->tinyMCE->getEditeurCommentaire(),
			"message" => $this->message->showMessages(),
			"recettes" => $viewAllCats
			));


	}


	public function indexCategorieAction($idCategorie){

		$viewAllCats  	= $this->modelViewCat->getViewCategorie($idCategorie);
		$viewAllCats 	= $viewAllCats['response'];
		//var_dump($viewAllCats);

		$titreCat = $viewAllCats[0]['categorie'];

		/*
		$recettesCat = array();
		foreach ($viewAllCats as $key => $viewCats) {
			if($viewCats['id_cat'] == $idCategorie){
				$recettesCat[$viewCats['id_recette']] = $viewCats ;
				$titreCat = $viewCats[0]['categorie'];
			}
		}*/
		
		$this->setDataView(array(
			"pageTitle" 		=> "Recettes ".$titreCat,
			"message" 			=> $this->message->showMessages(),
			"recettes"			=> $viewAllCats,
			"titreCat"			=> $titreCat
		));
	}
	public function categorieAction($idRecette){


		$viewRecette 	 	= $this->modelViewRecette->getViewRecette($idRecette);
		$viewRecette 		= $viewRecette['response'];



		$modelCommentaire 	= new \Application\Models\Commentaire('localhost');
		

		if(isset($_POST['btn'])){

			unset($_POST['btn']);
			$res =$modelCommentaire->insertCommentaire($_POST);


			if ($res['error']) {
				$this->message->addError("erreur pendant la recuperation des commentaires !");
			}
			$res = $res['response'];
			
		
			if ($res>0  ) {		//res est vaut l'id du comm
				
				$this->message->addSuccess("Commentaire ajouté");

			}else{
				$this->message->addError("Commentaire non ajouté");
			}
			
			if(empty($_POST['value'])){
				$this->message->addError("Commentaire vide !");
			}

			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));
				return false;
			}
			unset($listMessage);

			

			
		}
		


			//################## données pour la view ############################

		//recherche des commentaires
		$modelCommentaire 	= new \Application\Models\Commentaire('localhost');
		$viewComms = $modelCommentaire->getCommentaires($idRecette);

		$viewComms = $viewComms['response'];

		$this->setDataView(array(
			"pageTitle" 			=> "Recette santé, régime, cuisine légère",
			"message" 				=> $this->message->showMessages(),
			"viewCommentaires" 		=> $viewComms,
			"tinyMCECommentaire" 	=> $this->tinyMCE->getEditeurCommentaire(),
			"recette"				=> $viewRecette 
		));
		$this->setStyleView('categorie.css');
	}


























	public function indexChefAction(){



		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		//var_dump($viewAllRecettes);
		$viewAllRecettes 	= $viewAllRecettes['response'];

		//var_dump($viewAllRecettes); 		
		
		
		$this->setDataView(array(
			"pageTitle" 	=> "Recettes de chef cuisiniers",
			"message" 		=> $this->message->showMessages(),
			"recettes"		=> $viewAllRecettes
		));

		$this->setStyleView('indexchef.css');
	}

	public function chefAction($idRecette){
		$viewRecette 	 	= $this->modelViewRecette->getViewRecette($idRecette);
		$viewRecette 		= $viewRecette['response'][0];
		$this->setDataView(array(
			"pageTitle" 	=> $viewRecette['titre'],
			"message" 		=> $this->message->showMessages(),
			"tinyMCECommentaire" 	=> $this->tinyMCE->getEditeurCommentaire(),
			"recette"		=> $viewRecette 
		));
	}
	


	public function logoutAction(){		//a effacer?
		session_unset();
	}



	
}

