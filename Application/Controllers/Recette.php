<?php

namespace Application\Controllers;

class Recette extends \Library\Controller\Controller{

	private $message;
	private $modelCat;
	private $modelViewRecette;
	private $tinyMCE;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->tinyMCE				= new \Library\tinyMCE\tinyMCE();
		$this->message 				= new \Library\Message\Message();
		$this->modelCat 			= new \Application\Models\Categorie('localhost');
		$this->modelViewRecette 	= new \Application\Models\ViewRecette('localhost');
	}
		


	//elle sert à quoi cette page? a afficher une recette
	//ou toute les recettes cuisine du monde ?
	public function indexAction(){
		$viewAllRecette = $this->modelViewRecette->getAllViewRecettes() ;	//interroge le webservice
		$viewAllRecette 		= $viewAllRecette['response'];



		if(empty($viewRecette['response'])){
			$this->message->addError("aucune recette !");
		}elseif ($viewRecette['apiError'] ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $viewRecette['serverError'] ) {
			$this->message->addError($user->serverErrorMessage);
		}else{
			$viewRecette=$viewRecette['response'];
		}

		//var_dump("repérage",$viewAllRecette);


		
		echo "<br><br><br><br>".$idRecette;
		
		if( $_SESSION['user']['role'] !== "admin" ){
			$this->setRedirect(LINK_ROOT);
		}elseif( !isset($idRecette) || empty($idRecette)  || $idRecette===0 ){	//si pas d'idrecette
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

			
		}	
		




		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"tinyMCECommentaire" => $this->tinyMCE->getEditeurCommentaire(),
			"message" => $this->message->showMessages(),
			"viewRecette" => $viewAllRecette,
			"recettes" => $viewAllRecette
			));


	}


	public function indexChefAction(){



		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		var_dump($viewAllRecettes);
		$viewAllRecettes 	= $viewAllRecettes['response'];

		var_dump($viewAllRecettes); 		
		
		
		$this->setDataView(array(
			"pageTitle" 	=> "Recettes de chef cuisiniers",
			"message" 		=> $this->message->showMessages(),
			"tinyMCE" 		=> $this->tinyMCE->getSource(),
			"recettes"		=> $viewAllRecettes
		));
	}

	public function chefAction($id){
		$viewRecette 	 	= $this->modelViewRecette->getViewRecette($id);
		$viewRecette 		= $viewRecette['response'][0];
		$this->setDataView(array(
			"pageTitle" 	=> $viewRecette['titre'],
			"message" 		=> $this->message->showMessages(),
			"tinyMCE" 		=> $this->tinyMCE->getSource(),
			"recette"		=> $viewRecette 
		));
	}
	


	public function indexSanteAction(){
		$viewAllRecettes  	= $this->modelViewRecette->getAllViewRecettes();
		$viewAllRecettes 	= $viewAllRecettes['response'];
		//var_dump($viewAllRecettes);
		$this->setDataView(array(
			"pageTitle" => "Recette santé, régime, cuisine légère",
			"message" => $this->message->showMessages(),
			"recettes"		=> $viewAllRecettes
		));
	}

	public function santeAction($idRecette){
		$viewRecette 	 	= $this->modelViewRecette->getViewRecette($idRecette);
		$viewRecette 		= $viewRecette['response'];
		//var_dump($viewRecette);

		$modelCommentaire 	= new \Application\Models\Commentaire('localhost');
			unset($_POST['btn']);
			//var_dump($_POST);
			$res =$modelCommentaire->insertCommentaire($_POST);
			//var_dump("res : ", $res);

			if ($res['error']) {
				//$this->message->addError("erreur pendant la recuperation des commentaires !");
			}

			$res=$res['response'];
			
			if ($res>0  ) {		//res est vaut l'id du comm
				
				$this->message->addSuccess("Commentaire ajouté");

			}else{
				$this->message->addError("Commentaire non ajouté");
			}
		


			//################## données pour la view ############################

		//recherche des commentaires
		$modelCommentaire 	= new \Application\Models\Commentaire('localhost');
		$viewComms = $modelCommentaire->getCommentaires($idRecette);

		$viewComms = $viewComms['response'];

		$this->setDataView(array(
			"pageTitle" => "Recette santé, régime, cuisine légère",
			"message" 		=> $this->message->showMessages(),
			"viewCommentaires" => $viewComms,
			"tinyMCECommentaire" => $this->tinyMCE->getEditeurCommentaire(),
			"recette"		=> $viewRecette 
		));
	}



	public function logoutAction(){		//a effacer?
		session_unset();
	}



	
}

