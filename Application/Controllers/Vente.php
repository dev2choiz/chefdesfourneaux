<?php

namespace Application\Controllers;

class Vente extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelProduits;
	private $modelViewProduit; 
	private $modelPopUpProduit;
	private $modelShowDiv;
	private $modelAjax;


	public function __construct(){

		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelProduits 		= new \Application\Models\Produit('localhost');
		$this->modelViewProduit 	= new \Application\Models\ViewProduit('localhost');
		$this->modelPopUpProduit	= new \Application\Models\PopUpProduit();
		$this->modelShowDiv 		= new \Application\Models\ShowDiv();
		$this->modelAjax 			= new \Application\Models\Ajax();
		
		
	}


	

	public function indexProduitAction(){
		echo "<br><br><br><br><br>";
		echo "";
		

		$produits = $this->modelProduits->getAllProduits();
		$produits = $produits['response'];
		
		

		// Ajoute les infos du produits au html
		foreach ($produits as $key => $produit) {
			/*$viewPopupHtml = $this->modelPopUpProduit->getPopup( 	$produit['id_produit'], 
																$produit['prix'], 
																$produit['ref'],
																$produit['value']);*/
			$produits[$key]['popup']=$this->modelPopUpProduit->getPopup( 	$produit['id_produit'], 
																$produit['prix'], 
																$produit['ref'],
																$produit['value']);
		}
		
		
		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits,
			/*'ajax' => $viewPopupHtml,*/
			"urlWebService"			=> "
			<script type='text/javascript'>
				urlWebService='".WEBSERVICE_ROOT."/index.php';\n
			</script>"));

		$this->setStyleView('popup.css');

		$this->setScriptView('produit.js');

	}

	public function produitAction($idProduit){
		$produit = $this->modelProduits->getProduit($idProduit);
		//var_dump($produit);


		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produit' => $produit['response'][0],
			"urlWebService"			=> "
			<script type='text/javascript'>
				urlWebService='".WEBSERVICE_ROOT."/index.php';\n
			</script>" ));

	}







	public function indexLivreAction(){
		


		$modelAjax 	= new \Application\Models\Ajax('localhost');
		

		$this->setDataView(array(
			"pageTitle" => "Livres de Cuisine",
			"ajax" => $ajax
			));
	}

	public function livreAction(){
		
	}

	public function indexRestaurantAction(){
		


		$modelAjax 	= new \Application\Models\Ajax('localhost');
		

		$this->setDataView(array(
			"pageTitle" => "Nos restaurants partenaires",
			"ajax" => $ajax
			));


	}

	public function restaurantAction(){
		
	}
}