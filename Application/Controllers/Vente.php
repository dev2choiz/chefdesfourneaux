<?php

namespace Application\Controllers;

class Vente extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelProduits;
	private $modelViewProduit; 
	private $modelPopUpProduit;
	private $modelPanier;
	private $modelShowDiv;
	private $modelAjax;


	public function __construct(){

		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelProduits 		= new \Application\Models\Produit('localhost');
		$this->modelViewProduits 	= new \Application\Models\ViewListProduits('localhost');
		$this->modelPanier			= new \Application\Models\Panier('localhost');
		$this->modelPopUpProduit	= new \Application\Models\PopUpProduit();
		$this->modelShowDiv 		= new \Application\Models\ShowDiv();
		$this->modelAjax 			= new \Application\Models\Ajax();
		
		
	}


	

	public function indexProduitAction(){

		$produits = $this->modelProduits->getAllProduits();
		$produits = $produits['response'];
		
		

		// Ajoute les infos du produits au html
		foreach ($produits as $key => $produit) {
			
			$produits[$key]['acheterpopup'] = $this->modelPopUpProduit->getAcheterPopup(
															$produit['id_produit'], 
															$produit['prix'], 
															$produit['ref'],
															$produit['value']);

		}

		// Ajoute les infos du produits au html
		if(!empty($_SESSION['user']) && $_SESSION['user']['role'] == "admin" ){
			foreach ($produits as $key => $produit) {

				$produits[$key]['modifierpopup'] = $this->modelPopUpProduit->getModifPopup(
																	$produit['id_produit'], 
																	$produit['prix'], 
																	$produit['ref'],
																	$produit['value']);

			}
		}

		
		
		$this->setDataView(array(
			'message' => $this->message->showMessages(),
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits
			)
		);

		$this->setStyleView('popup.css');
		$this->setStyleView('produit.css');

		$this->setScriptView('produit.js');

	}

	public function produitAction($idProduit){
		
		$produit = $this->modelProduits->getProduit($idProduit);
		$produit = $produit['response'][0];
		$viewProduits = $this->modelViewProduits->getViewListProduitsByProduit($idProduit);


		// Ajoute les infos du produits au html
		$produit['acheterpopup'] = $this->modelPopUpProduit->getAcheterPopup(
														$produit['id_produit'], 
														$produit['prix'], 
														$produit['ref'],
														$produit['value']);

		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produit' => $produit,
			'viewProduits' => $viewProduits
			)
		);

		$this->setStyleView('produit.css');

	}




	public function indexLivreAction(){
		
		

		$this->setDataView(array(
			"pageTitle" => "Livres de Cuisine"
			)
		);
	}

	public function livreAction(){
		
	}

	public function indexRestaurantAction(){
		

		$this->setDataView(array(
			"pageTitle" => "Nos restaurants partenaires"
			)
		);


	}

	public function restaurantAction(){
		
	}
}