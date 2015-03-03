<?php

namespace Application\Controllers;

class Produit extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;
	private $modelCat;
	private $modelViewProduit;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelCat 			= new \Application\Models\Categorie('localhost');
		$this->modelViewProduit 	= new \Application\Models\Produit('localhost');
	}

	public function indexAction(){
		
		$viewAllProduits = $this->modelViewProduit->getProduits() ;			



		if(empty($viewAllProduits['response'])){
			$this->message->addError("aucune recette !");
		}elseif ($viewAllProduits['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewAllProduits['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}


		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes" => $viewAllProduits
			));

	}







public function afficherAction( $idProduit ){
		
		$viewProduit = $this->modelViewProduit->getViewProduit($idProduit);



		if(empty($viewProduit['response'])){
			$this->message->addError("aucune recette !");
		}elseif ($viewProduit['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewProduit['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}else{
			$viewProduit=$viewProduit['response'];
		}

		var_dump("repérage",$viewProduit);


		
		echo "<br><br><br><br>".$idProduit;
		
		if( $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}elseif( !isset($idProduit) || empty($idProduit)  || $idProduit===0 ){	//si pas d'idrecette
			$this->setRedirect(LINK_ROOT."admin/");
		}


		
		if(isset($_POST['btn'])){
			var_dump($_POST);

			
			
			if(empty($_POST['value'])){
				$this->message->addError("Commentaire vide !");
			}

			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));
				return false;
			}

			unset($_POST['btn'], $listMessage);

			
			$modelCommentaire 	= new \Application\Models\Commentaire('localhost');
			
			$res =$modelCommentaire->insertCommentaire($_POST);
			var_dump("res : ", $res);

			if ($res['error']) {
				$this->message->addError("erreur pendant la recuperation des commentaires !");
			}

			$res=$res['response'];
			
			if ($res>0  ) {		//res est vaut l'id du comm
				
				$this->message->addSuccess("Commentaire ajouté");

			}else{
				$this->message->addError("Commentaire non ajouté");
			}
		}




		//################## données pour la view ############################

		//recherche des commentaires
		$modelCommentaire 	= new \Application\Models\Commentaire('localhost');
		$viewComms=$modelCommentaire->getCommentaires($idProduit);

		$viewComms=$viewComms['response'];
		




		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"tinyMCECommentaire" => $this->tinyMCE->getEditeurCommentaire(),
			"message" => $this->message->showMessages(),
			"viewProduit" => $viewProduit,
			"viewCommentaires" => $viewComms
			));


	}



	public function logoutAction(){		//a effacer?
		session_unset();
	}



	
}

