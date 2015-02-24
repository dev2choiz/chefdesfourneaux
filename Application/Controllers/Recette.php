<?php

namespace Application\Controllers;

class Recette extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelCat;
	private $modelViewRecette;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelCat 			= new \Application\Models\Categorie('localhost');
		$this->modelViewRecette 	= new \Application\Models\ViewRecette('localhost');
	}



		


	//elle sert à quoi cette page? a afficher une recette
	//ou toute les recettes cuisine du monde ?
	public function indexAction(){
		$viewAllRecette = $this->modelViewRecette->getAllViewRecettes() ;	//interroge le webservice
		$viewAllRecette 		= $viewAllRecette['response'];
		

		//var_dump($viewRecettes);


		if(empty($viewRecette['response'])){					//<== avec ou sans 's'?
			$this->message->addError("aucune recette !");
		}elseif ($viewRecette['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewRecette['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}


		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $viewAllRecette
			));

	}

	public function indexChefAction(){


		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		$viewAllRecettes 	= $viewAllRecettes;
		var_dump($viewAllRecettes); 		
		
		
		$this->setDataView(array(
			"pageTitle" 	=> "Recettes de chef cuisiniers",
			"message" 		=> $this->message->showMessages(),
			"tinyMCE" 		=> $this->tinyMCE->getSource(),
			"recettes"		=> $viewAllRecettes
		));
	}

	public function chefAction($id){
		$viewRecette 	 	= $this->modelViewRecette->getViewRecette($id);
		$viewRecette 		= $viewRecette['response'][0];
		$this->setDataView(array(
			"pageTitle" 	=> $viewRecette['titre'],
			"message" 		=> $this->message->showMessages(),
			"tinyMCE" 		=> $this->tinyMCE->getSource(),
			"recette"		=> $viewRecette 
		));
	}
	


	public function indexSanteAction(){
		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		$viewAllRecettes 	= $viewAllRecettes['response'];
		//var_dump($viewAllRecettes);
		$this->setDataView(array(
			"pageTitle" => "Recette santé, régime, cuisine légère",
			"message" => $this->message->showMessages(),
			"tinyMCE" 		=> $this->tinyMCE->getSource(),
			"recettes"		=> $viewAllRecettes
		));
	}

	public function santeAction($id){
		$viewRecette 	 	= $this->modelViewRecette->getViewRecette($id);
		$viewRecette 		= $viewRecette['response'][0];
		$this->setDataView(array(
			"pageTitle" => "Recette santé, régime, cuisine légère",
			"message" 		=> $this->message->showMessages(),
			"tinyMCE" => $this->tinyMCE->getSource(),
			"recette"		=> $viewRecette 
		));
	}



	public function logoutAction(){		//a effacer?
		session_unset();
	}



	
}