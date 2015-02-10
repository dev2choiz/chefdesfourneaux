<?php

namespace Application\Controllers;

class Admin extends \Library\Controller\Controller{

	private $message;
	private $tinyMCE;

	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message = new \Library\Message\Message();
		$this->tinyMCE=new \Library\TinyMCE\tinyMCE();
	}


	public function indexAction(){
		
	}

	public function creerAction(){
		//echo "creer    ".LINK_ROOT."recette/creer";
		if($_SESSION['user']['role'] !== "admin"){
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
		//var_dump($cat);

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

	public function mettreajourAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}

	public function supprimerAction(){
		if($_SESSION['user']['role'] !== "admin"){
			header('location: '.LINK_ROOT);
			die();
		}
	}



	public function logoutAction(){
		session_unset();
	}
}