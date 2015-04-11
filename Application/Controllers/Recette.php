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

		$viewAllCats  	= $this->modelCat->getCategories();

		if(empty($viewAllCats)){
			$this->message->addError("aucune recette !");
		}elseif ($viewAllCats['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewAllCats['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}else{
			$viewAllCats=$viewAllCats['response'];
		}

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

		$titreCat = $viewAllCats[0]['categorie'];

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
			
		//declare la variable jsIdRecette
		$this->setJsConfigAvant("variable", "IdRecette", $idRecette );			

			
		
		


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
		$this->setScriptView('categorie.js');
	}





	/**
	 * [indexChefAction Affiche la liste des recettes de chef]
	 * @return [void] 
	 */
	public function indexChefAction(){



		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		$viewAllRecettes 	= $viewAllRecettes['response'];		
		
		
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

	public function typeAction($type){
		$viewRecette 	 	= $this->modelViewRecette->getAllViewRecettes();
		$viewRecette 		= $viewRecette['response'];
		//var_dump($viewRecette);

		$this->setDataView(array(
			"pageTitle" 	=> 'Recettes de cuisine, '.$type,
			"message" 		=> $this->message->showMessages(),
			"type"			=> $type,
			"recettes"		=> $viewRecette 
		));
	}
	


	public function logoutAction(){		//a effacer?
		session_unset();
	}



	
}

