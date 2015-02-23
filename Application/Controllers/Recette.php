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

	public function indexAction(){
		//echo "indexdjkl".LINK_ROOT."recette/creer"; die();
		//$this->setRedirect(LINK_ROOT."recette/creer");


		$viewRecette = $this->modelViewRecette->getViewRecette() ;	//interroge le webservice

		//var_dump($viewRecettes);

		if(empty($viewRecette->response)){
			$this->message->addError("aucune recette !");
		}elseif ($viewRecette->apiError ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewRecette->serverError ) {
			$this->message->addError($user->serverErrorMessage);
		}


		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $viewRecette->response
			));

	}

	public function indexChefAction(){


		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		$viewAllRecettes 	= $viewAllRecettes['response'];
		//var_dump($viewAllRecettes); 		
		
		
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
	


	public function santeAction(){
		$this->setDataView(array(
			"pageTitle" => "Recette santé, régime, cuisine légère",
			"tinyMCE" => $this->tinyMCE->getSource()
		));
	}



	public function logoutAction(){
		session_unset();
	}



	
}