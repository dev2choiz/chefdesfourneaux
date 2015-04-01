<?php
 
namespace Application\Controllers;

class AdminProduit extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelProduits;
	private $modelListProduit;
	private $modelViewProduit; 
	private $modelViewRecette; 
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
		$this->modelListProduit		= new \Application\Models\ListProduit('localhost');
		$this->modelViewRecette 	= new \Application\Models\ViewRecette('localhost');
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
		//var_dump($produits);
		$produits = $produits['response'];
		

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


	public function lierProduitAction( $idRecette ){
		if( !$this->isConnected() || $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}

		$produits = $this->modelProduits->getAllProduits();
		$viewRecette = $this->modelViewRecette->getViewRecette($idRecette)['response'];
		

		if(empty($viewProduit['response'])){
			$this->message->addError("aucun produit !");
		}elseif ($viewProduit['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewProduit['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);	
		}

		$produits=$produits['response'];
		

		$listProd = $this->convEnTab( $this->modelListProduit->getListProduit($idRecette) );
		
		$listProd=$listProd['response'];
		

		//recherche lesproduits associés a la recette
		if(!empty($listProd)){
			foreach ( $produits as $key => $produit ) {
				$produits[$key]['associe']=false;

				foreach ($listProd as $key2 => $prod) {
					
					if($prod['id_produit']===$produit['id_produit']){
						$produits[$key]['associe']=true;
						
					}
					
				}
			}
		}
		
		
		//var_dump($listProd,$produits);

		
		


		
		
		



		if( !empty($_SESSION['user']) && $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}elseif( !isset($idRecette) || empty($idRecette)  || $idRecette===0 ){	//si pas d'idrecette
			$this->setRedirect(LINK_ROOT."admin/");
		}


		
		if(isset($_POST['btn'])){
			var_dump($_POST);

			
		}
		


		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"produits" => $produits,
			"viewRecette" => $viewRecette
			)
		);
		



	}

}