<?php

namespace Application\Controllers;

class Vente extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelProduits;
	private $modelViewProduit; 
	private $modelPopup;	//<==effacer
	private $modelShowDiv;
	private $modelAjax;


	public function __construct(){

		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelProduits 		= new \Application\Models\Produit('localhost');
		$this->modelViewProduit 	= new \Application\Models\ViewProduit('localhost');
		$this->modelPopup 			= new \Application\Models\PopUp();
		$this->modelShowDiv 		= new \Application\Models\ShowDiv();
		$this->modelAjax 			= new \Application\Models\Ajax();
		
		
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
		$produits = $produits['response'];
		// Ajoute le infos sur les produits au html
		foreach ($produits as $produit) {
			$viewPopupHtml = $this->modelPopup->getHtmlPopup( 	$produit['id_produit'], 
																$produit['prix'], 
																$produit['ref'],
																$produit['value']);
		}
		

		//$codeAjaxProduit = $viewPopupHtml."".$viewPopupScript;

		/*
		$scriptAjax = $this->modelAjax->getAjaxPost( 	array( "value"=>"popupContainer"),
													 	"produit", 
													 	"insertproduit", 
													 	array(), 
														"ajouterProduit", 
														$successfonc );

		//$viewButtonPopupProduit = $this->modelPopup->getHtmlButtonPopup( "ajouterProduitBdd", "Ajouter un produit");

		if(isset($_POST["btnProduit"])){
			unset($_POST["btnProduit"]);
			$this->modelProduits->insertProduit($_POST);
		}*/
		
		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits,
			'ajax' => $viewPopupHtml,
			"urlWebService"			=> "
			<script type='text/javascript'>
				urlWebService='".WEBSERVICE_ROOT."/index.php';\n
			</script>"));

		$this->setStyleView('popup.css');

		$this->setScriptView('produit.js');

	}

	public function produitAction(){
		$produits = $this->modelProduits->getAllProduits();
		//var_dump($produits);


		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits['response'],
			"urlWebService"			=> "
			<script type='text/javascript'>
				urlWebService='".WEBSERVICE_ROOT."/index.php';\n
			</script>" ));

	}


	public function livreAction(){
		
	}

	public function restaurantAction(){
		
	}
}