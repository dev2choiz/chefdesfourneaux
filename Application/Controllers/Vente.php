<?php

namespace Application\Controllers;

class Vente extends \Library\Controller\Controller{

	private $modelProduits;


	public function __construct(){

		$this->setLayout("carousel");
		
		$this->modelProduits = new \Application\Models\Produit('localhost');
		
	}


	public function indexLivreAction(){
		


		$modelAjax 	= new \Application\Models\Ajax('localhost');
		
		$ajax= $modelAjax->getAjaxPost("viewrecette", "getallviewrecettes", array(), "console.log(data);"  );

		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"ajax" => $ajax
			));


	}

	public function indexRestaurantAction(){
		


		$modelAjax 	= new \Application\Models\Ajax('localhost');
		
		$ajax= $modelAjax->getAjaxPost("viewrecette", "getallviewrecettes", array(), "console.log(data);"  );

		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"ajax" => $ajax
			));


	}

	public function indexProduitAction(){
		$produits = $this->modelProduits->getAllProduits();
		//var_dump($produits);

		$ajax = "coucou";
		if(isset($_POST["btnProduit"])){
			unset($_POST["btnProduit"]);
			$this->modelProduits->insertProduit($_POST);
		}
		
		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits['response'],
			'ajax' => $ajax ));

	}

	public function produitAction(){
		$produits = $this->modelProduits->getAllProduits();
		//var_dump($produits);

		$ajax = "coucou";

		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits['response'],
			'ajax' => $ajax ));

	}


	public function livreAction(){
		
	}

	public function restaurantAction(){
		
	}
}