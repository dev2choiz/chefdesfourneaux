<?php

namespace Application\Controllers;

class Index extends \Library\Controller\Controller
{
	private $message;
	private $modelViewRecette;
	
	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->modelViewRecette 	= new \Application\Models\ViewRecette('localhost');
		$this->modelProduits 		= new \Application\Models\Produit('localhost');
	}


	public function indexAction(){

		// Récupération des vues des recettes 
		$viewAllRecettes 		= $this->modelViewRecette->getAllViewRecettes() ;
		if(!empty($viewAllRecettes['response'])){
			$viewAllRecettes = $viewAllRecettes['response'];
		}else{
			$this->message->addError("Erreur dans la récupération des recettes");
		}



		// Récupération des produits
		$produitsAll = $this->modelProduits->getAllProduits();
		if(!empty($produitsAll['response'])){
			$produitsAll = $produitsAll['response'];
		}else{
			$this->message->addError("Erreur dans la récupération des produits");
		}


		$this->setDataView(array(
			"pageTitle" => "Chef des fourneaux, site de recettes, cuisine de chef et vente electroménager",
			"message" => $this->message->showMessages(),
			"recettes" => $viewAllRecettes,
			"produits" => $produitsAll
		));

		$this->setStyleView('index.css');
		//$this->setScriptView('index.js');
	}

}