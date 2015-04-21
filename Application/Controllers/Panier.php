<?php

namespace Application\Controllers;

class Panier extends \Library\Controller\Controller{

	private $message;
	private $modelCat;
	private $modelViewPanier;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->modelCat 			= new \Application\Models\Categorie('localhost');
		$this->modelViewPanier 		= new \Application\Models\ViewPanier('localhost');
		$this->modelViewProduit 	= new \Application\Models\Produit('localhost');
	}

	/**
	 * [indexPanierAction affiche le panier de l'utilisateur connecté]
	 * @param  [int] $idUser [id de l'utilisateur connecté]
	 * @return void
	 */
	public function indexPanierAction($idUser){

		if(!isset($_SESSION['user'])){
			$this->setRedirect(LINK_ROOT);
		}

		//verifie si il y a des actions a realiser, comme delete un produit
		if(isset($_POST['action'])){
			

			if($_POST['action'] === "Supprimer du panier"){

				$modelPanier 	= new \Application\Models\Panier('localhost');

				$res = $modelPanier->deletePanier($_SESSION['user']['id_user']+0, $_POST['id_panier']+0);
				
				$res = $res['response'];
				

				if (!$res) {
					$this->message->addError($res['apiErrorMessage']);
				}else{
					$this->message->addSuccess("Produit supprimé !");
				}

			}
		}

		//affichage du panier
		if ( !empty($_SESSION['user']) ) {
			$viewPanier	=	$this->modelViewPanier->getViewPanierByUser($idUser);
			$viewPanier	=	$viewPanier ['response'];
			$viewPanier	= 	(!$viewPanier) ? array() : $viewPanier;
		}else{
			$viewPanier = array();
		}	


		$this->setDataView(array(
			"pageTitle" => "Votre panier",
			"message" => $this->message->showMessages(),
			"viewPanier" => $viewPanier));

		$this->setStyleView('indexpanier.css');

	}

	/**
	 * [payerAction affiche la page de redirection pour le paiement]
	 * @return void
	 */
	public function payerAction(){

		if(!isset($_SESSION['user'])){
			$this->setRedirect(LINK_ROOT);
		}

		$this->setDataView(array(
			"pageTitle" => "Paiement, Finalisation de votre commande",
			)
		);

	}
	
}

