<?php

namespace Application\Controllers;

class Vente extends \Library\Controller\Controller{

	private $modelProduits;
	private $codAjax;


	public function __construct(){

		$this->setLayout("carousel");
		
		$this->modelProduits = new \Application\Models\Produit('localhost');
		$this->codeAjax = $viewShowDivHtml."".$viewShowDivScript;
		
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

		//script ajax permettant d'ajouter un ingredient a la bdd puis de le prendre en compte
		$successfonc = "
			console.log(data);
			
		";
		$scriptAjax = $this->modelAjax->getAjaxPost( 	array( "value"=>"popupContainer"),
													 	"produit", 
													 	"insertproduit", 
													 	array(), 
														"ajouterProduitBdd", 
														$successfonc );

		$viewButtonPopupProduit = $this->modelPopup->getHtmlButtonPopup( "ajouterProduitBdd", "Ajouter un produit");

		$viewPopupScript = $this->modelPopup->getScriptPopup( "DivContainerProduit",	
																	"ajouterProduitBdd", 
																	$scriptAjax, 
																	"ajouterProduitBdd");

		$viewPopupHtml = $this->modelPopup->getHtmlPopup( 	"d'un produit", 
															"Produit", 
															"cet produit");

		$codeAjaxProduit = $this->codeAjax;


		if(isset($_POST["btnProduit"])){
			unset($_POST["btnProduit"]);
			$this->modelProduits->insertProduit($_POST);
		}
		
		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits['response'],
			'ajax' => $ajax ));

		$this->setStyleView('popup');

	}

	public function produitAction(){
		$produits = $this->modelProduits->getAllProduits();
		//var_dump($produits);


		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits['response'] ));

	}


	public function livreAction(){
		
	}

	public function restaurantAction(){
		
	}
}