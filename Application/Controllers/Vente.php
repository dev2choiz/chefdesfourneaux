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
		$this->modelViewProduit 	= new \Application\Models\ViewProduit('localhost');
		$this->modelPanier			= new \Application\Models\Panier('localhost');
		$this->modelPopUpProduit	= new \Application\Models\PopUpProduit();
		$this->modelShowDiv 		= new \Application\Models\ShowDiv();
		$this->modelAjax 			= new \Application\Models\Ajax();
		
		
	}


	

	public function indexProduitAction(){
		echo "<br><br><br><br><br><br><br><br><br><br>";
		echo "";
		// if($_SESSION['user']['role'] !== "admin") $this->setRedirect(LINK_ROOT);

		$produits = $this->modelProduits->getAllProduits();
		$produits = $produits['response'];
		

		

		// Ajoute les infos du produits au html
		foreach ($produits as $key => $produit) {

			/*$produits[$key]['modifierpopup']=$this->modelPopUpProduit->getModifPopup(
																$produit['id_produit'], 
																$produit['prix'], 
																$produit['ref'],
																$produit['value']);*/


			/*if(!empty($_SESSION['user'])){
				$tst=$this->modelPanier->existeDansPanier($_SESSION['user']['id_user'], $produit['id_produit']);
			}*/
			
			$produits[$key]['acheterpopup']=$this->modelPopUpProduit->getAcheterPopup(
															$produit['id_produit'], 
															$produit['prix'], 
															$produit['ref'],
															$produit['value']);

		}
		
		
		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produits' => $produits
			)
		);

		$this->setStyleView('popup.css');

		$this->setScriptView('produit.js');

	}

	public function produitAction($idProduit){
		$produit = $this->modelProduits->getProduit($idProduit);
		//var_dump($produit);


		$this->setDataView(array(
			'pageTitle' => "Vente d'ustensile de cuisine, vente d'électroménager semi-pro",
			'produit' => $produit['response'][0]
			)
		);

	}


	public function payerAction(){
		echo '<br><br><br><br><br><br>';

		$this->setDataView(array(
			"pageTitle" => "Finalisation de votre commande",
			)
		);

	}




	public function indexLivreAction(){
		


		$modelAjax 	= new \Application\Models\Ajax('localhost');
		

		$this->setDataView(array(
			"pageTitle" => "Livres de Cuisine",
			"ajax" => $ajax
			)
		);
	}

	public function livreAction(){
		
	}

	public function indexRestaurantAction(){
		


		$modelAjax 	= new \Application\Models\Ajax('localhost');
		

		$this->setDataView(array(
			"pageTitle" => "Nos restaurants partenaires",
			"ajax" => $ajax
			)
		);


	}

	public function restaurantAction(){
		
	}
}