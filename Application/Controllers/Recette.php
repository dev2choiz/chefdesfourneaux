<?php

namespace Application\Controllers;

class Recette extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;

	public function __construct(){
		parent::__construct();
		$this->setLayout("blog");
		$this->message = new \Library\Message\Message();
		$this->tinyMCE=new \Library\TinyMCE\tinyMCE();
	}

	public function indexAction(){
		//echo "indexdjkl".LINK_ROOT."recette/creer"; die();
		//$this->setRedirect(LINK_ROOT."recette/creer");
		
		$modelRecette 	= new \Application\Models\Recette('localhost');
		$recettes 		= $modelRecette->getRecettes() ;	//interroge le webservice
		//var_dump($recettes);

		if(empty($recettes->response)){
			$this->message->addError("aucune recette !");
		}elseif ($recettes->apiError ) {
			$this->message->addError($user->apiErrorMessage);
		}elseif ( $recettes->serverError ) {
			$this->message->addError($user->serverErrorMessage);
		}


		$this->setDataView(array(
			"message" => $this->message->showMessages(),
			"recettes" => $recettes->response
			));

	}


	public function profilAction(){

		if(empty($_SESSION['user'])){
			header('location: '.LINK_ROOT);
			die();
		}

		$this->setLayout("blog");
		$this->setDataView(array("pageTitle" => "Update profil"));


		if(isset($_POST['btn'])){

			if(empty($_POST['nom'])){
				$this->message->addError("Nom vide !");
			}elseif(strlen($_POST['nom'])>50){
				$this->message->addError("Nom trop long !");
			}

			if(empty($_POST['prenom'])){
				$this->message->addError("Prenom vide !");
			}elseif(strlen($_POST['prenom'])>50){
				$this->message->addError("Prenom trop long !");
			}

			if(empty($_POST['mail'])){
				$this->message->addError("Mail vide !");
			}elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				$this->message->addError("Mail non valide !");
			}

			if(!empty($_POST['password'])){
				if(isset($_POST['confpassword']) && $_POST['password'] !== $_POST['confpassword']){
					$this->message->addError("Confirmation password non valide !");
				}
				$_POST['password'] = md5($_POST['password'].SALT_PASSWORD);
			}else{
				unset($_POST['password']);
			}
			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));	
				return false;
			}

			$currentpassword = md5($_POST['currentpassword'].SALT_PASSWORD);
			unset($_POST['btn'], $_POST['confpassword'], $_POST['currentpassword'], $listMessage);

			
			$modelUser = new \Application\Models\User('localhost');

			$user = $modelUser->fetchAll("`id`={$_SESSION['user']->id} AND `password`='$currentpassword'", "`id`");
			if(!empty($user[0])){

				if($modelUser->update("`id`={$_SESSION['user']->id} AND `password`='$currentpassword'", $_POST, false)){
					
					$user = $modelUser->findByPrimary($_SESSION['user']->id, "`id`,`nom`,`prenom`,`mail`,`update`");
					if(!empty($user[0])){
						$_SESSION['user'] = $user[0];
						$this->message->addSuccess("Update valide");
					}else{
						$this->message->addError("Update Failure !");
					}

				}else{
					$this->message->addError("Mail déjà existant en base !");
				}

			}else{
				$this->message->addError("Password non valide !");
			}
		}


		$this->setDataView(array("message" => $this->message->showMessages()));
	}




	public function creerAction(){
		//echo "creer    ".LINK_ROOT."recette/creer";
		if(empty($_SESSION['user'])){
			header('location: '.LINK_ROOT);
			die();
		}
		
		$this->setDataView(array(
			"pageTitle" => "Créer une recette",
			"tinyMCE" => $this->tinyMCE->getSource()
			));

		
		if(isset($_POST['btn'])){

			if(empty($_POST['value'])){
				$this->message->addError("Recette vide !");
			}

			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));

				return false;
			}

			unset($_POST['btn'], $listMessage);

			



			$modelRecette 	= new \Application\Models\Recette('localhost');
			$res =$modelRecette->insertRecette($_POST,  $_SESSION['user']['id_user']);
			//echo $res;
			//var_dump( $_POST);

			if ($res ) {
				//header('location: '.LINK_ROOT.'recette');
				//die();
			}else{
				$this->message->addError($user->apiErrorMessage);
				$this->message->addError($user->serverErrorMessage.$res);
			}
		}


		//données pour la view
		//
		$this->setDataView(array("message" => $this->message->showMessages()));

		//recherche des categories
		$modelCategorie 	= new \Application\Models\Categorie('localhost');
		$cat=$modelCategorie->getCategories();

		
		$cat=$cat->response;
		
		

		$cat=$modelCategorie->convEnTab($cat);
		var_dump($cat);

		/*array (size=4)
	      0 => 
	        object(stdClass)[11]
	          public 'id_cat' => int 1
	          public 'value' => string 'Cuisine du monde' (length=16)
	      1 => 
	        object(stdClass)[12]
	          public 'id_cat' => int 2
	          public 'value' => string 'Cuisine authentique' (length=19)
	      2 => 
	        object(stdClass)[13]
	          public 'id_cat' => int 3
	          public 'value' => string 'SantÃ©' (length=6)
	      3 => 
	        object(stdClass)[14]
	          public 'id_cat' => int 4
	          public 'value' => string 'VÃ©gÃ©tarien' (length=12)*/
		

		$this->setDataView(array("categories" =>  $cat));
	}



	public function logoutAction(){
		session_unset();
	}



	public function inscriptionAction(){

		if(!empty($_SESSION['user'])){
			header('location: '.LINK_ROOT);
			die();
		}

		$this->setDataView(array("pageTitle" => "Inscription"));


		if(isset($_POST['btn'])){

			if(empty($_POST['nom'])){
				$this->message->addError("Nom vide !");
			}elseif(strlen($_POST['nom'])>50){
				$this->message->addError("Nom trop long !");
			}

			if(empty($_POST['prenom'])){
				$this->message->addError("Prenom vide !");
			}elseif(strlen($_POST['prenom'])>50){
				$this->message->addError("Prenom trop long !");
			}

			if(empty($_POST['mail'])){
				$this->message->addError("Mail vide !");
			}elseif(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
				$this->message->addError("Mail non valide !");
			}

			if(empty($_POST['password'])){
				$this->message->addError("Password vide !");
			}elseif($_POST['password'] !== $_POST['confpassword']){
				$this->message->addError("Confirmation password non valide !");
			}
			
			$listMessage = $this->message->getMessages("error");
			if(!empty($listMessage)){
				$this->setDataView(array("message" => $this->message->showMessages()));	
				return false;
			}

			unset($_POST['btn'], $_POST['confpassword'], $listMessage);
			$_POST['password'] = md5($_POST['password'].SALT_PASSWORD);

			
			$modelUser = new \Application\Models\User('localhost');
			if($modelUser->insert($_POST)){
				$this->message->addSuccess("Inscription valide");
				header('location: '.LINK_ROOT.'user/login');
				die();
			}else{
				$this->message->addError("Mail déjà existant en base !");

			}
		}
		$this->setDataView(array("message" => $this->message->showMessages()));	
	}
}