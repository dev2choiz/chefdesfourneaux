<?php
 
namespace Application\Controllers;

class AdminProduit extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelProduits;
	private $modelViewProduit; 
	private $modelPopUpProduit;
	private $modelPanier;
	private $modelShowDiv;
	private $modelAjax;


	public function __construct(){
		parent::__construct();
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


	public function indexAction(){
		


		if( !$this->isConnected() || $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}
	

		$produits = $this->modelProduits->getAllProduits();
		$produits = $produits['response'];
		//var_dump($produits);
		

		

		// Ajoute les infos du produits au html
		foreach ($produits as $key => $produit) {

			$produits[$key]['modifierpopup']=$this->modelPopUpProduit->getModifPopup(
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


		// Chargement des scripts
		$this->setStyleView('popup.css');
		$this->setStyleView('produit.css');

		// Chargement des scripts
		$this->setScriptView('produit.js');
	}
}