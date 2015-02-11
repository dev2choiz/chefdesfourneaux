<?php

namespace Application\Controllers;

class Recette extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;

	public function __construct(){
		parent::__construct();
		$this->setLayout("blog");
		$this->message = new \Library\Message\Message();
		$this->tinyMCE=new \Library\TinyMCE\tinyMCE();
	}

	public function categorieAction(){
		//echo "indexdjkl".LINK_ROOT."recette/creer"; die();
		//$this->setRedirect(LINK_ROOT."recette/creer");
		
		$modelRecette 	= new \Application\Models\Recette('localhost');
		$recettes 		= $modelRecette->getRecettes() ;	//interroge le webservice
		//var_dump($recettes);

		if(empty($recettes->response)){
			$this->message->addError("aucune recette !");
		}elseif ($recettes->apiError ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $recettes->serverError ) {
			$this->message->addError($user->serverErrorMessage);
		}


		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $recettes->response
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