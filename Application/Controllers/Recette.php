<?php

namespace Application\Controllers;

class Recette extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelCat;
	private $modelViewRecettes;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelCat 			= new \Application\Models\Categorie('localhost');
		$this->modelViewRecettes 	= new \Application\Models\ViewRecettes('localhost');
	}

	public function indexAction(){
		//echo "indexdjkl".LINK_ROOT."recette/creer"; die();
		//$this->setRedirect(LINK_ROOT."recette/creer");
		
		$viewRecettes = $this->modelViewRecettes->getViewRecettes() ;	//interroge le webservice
		//var_dump($viewRecettes);

		if(empty($viewRecettes->response)){
			$this->message->addError("aucune recette !");
		}elseif ($viewRecettes->apiError ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewRecettes->serverError ) {
			$this->message->addError($user->serverErrorMessage);
		}


		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $viewRecettes->response
			));

	}

	public function chefAction(){
		$this->setDataView(array(
			"pageTitle" => "Recettes de chef",
			"tinyMCE" => $this->tinyMCE->getSource()
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