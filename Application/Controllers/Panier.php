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

	public function indexPanierAction($idUser){


	


		//verifie si il y a des actions a realiser, comme delete un produit
		if(isset($_POST['action'])){
			

			if($_POST['action']==="delete"){
				echo "delete";
				$modelPanier 	= new \Application\Models\Panier('localhost');
				
				$res =$modelPanier->deletePanier($_SESSION['user']['id_user']+0, $_POST['id_produit']+0);
				//var_dump("res : ", $res);
				
				$res=$res['response'];
				

				if (!$res) {
					$this->message->addError("erreur pendant lasuppresion du produit dans le panier !");
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
		//var_dump(" post pui view",$_POST, $viewPanier );


		$this->setDataView(array(
			"pageTitle" => "Votre panier",
			"message" => $this->message->showMessages(),
			"viewPanier" => $viewPanier,
			"urlWebService"			=> "
			<script type='text/javascript'>
				urlWebService='".WEBSERVICE_ROOT."/index.php';\n
			</script>" ));

	}







public function afficherAction( $idPanier ){
		
		$viewPanier = $this->modelViewPanier->getViewPanier($idPanier);



		if(empty($viewPanier['response'])){
			$this->message->addError("aucune recette !");
		}elseif ($viewPanier['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewPanier['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}else{
			$viewPanier=$viewPanier['response'];
		}

		var_dump("repérage",$viewPanier);


		
		echo "<br><br><br><br>".$idPanier;
		
		if( $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}elseif( !isset($idPanier) || empty($idPanier)  || $idPanier===0 ){	//si pas d'idrecette
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
		$viewComms=$modelCommentaire->getCommentaires($idPanier);

		$viewComms=$viewComms['response'];
		




		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"tinyMCECommentaire" => $this->tinyMCE->getEditeurCommentaire(),
			"message" => $this->message->showMessages(),
			"viewPanier" => $viewPanier,
			"viewCommentaires" => $viewComms
			));
	}



	public function logoutAction(){		//a effacer?
		session_unset();
	}



	
}

