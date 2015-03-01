<?php

namespace Application\Controllers;

class Index extends \Library\Controller\Controller
{
	private $message;
	private $tinyMCE;
	private $modelViewRecette;
	
	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelViewRecette 	= new \Application\Models\ViewRecette('localhost');
		$this->modelPopUp 			= new \Application\Models\PopUp('localhost');
		$this->modelAjax 			= new \Application\Models\Ajax('localhost');
	}


	public function indexAction(){
		echo "<br><br><br>";
		echo "<br><br><br>";

		 
		$viewAllRecettes 		= $this->modelViewRecette->getAllViewRecettes() ;
		if(!empty($viewAllRecettes['response'])){
			$viewAllRecettes=$viewAllRecettes['response'];
			//var_dump("##################################", $viewRecettes);
		}else{
			$this->message->addError("pas de Recettes");
		}

		//$viewRecettes = $this->modelViewRecette->getViewRecette($id);

		$viewPopUpScript = $this->modelPopUp->getScriptPopUp('categorie', 'container', 'popup');

		$textPopUpCategorie = "
		<input type='button' onclick='obtenirViewRecettes();' value='getview' >
		";

		$viewPopUpHtml = $this->modelPopUp->getHtmlPopUp('container', 'popup', $textPopUpCategorie);

		$codeAjax=$this->modelAjax->getAjaxPost("ViewRecette", "getAllViewRecettes", array(), "obtenirViewRecettes" , "console.log(data);"  ).$viewPopUpScript."".$viewPopUpHtml;

		$this->setDataView(array(
			"pageTitle" => "Maitres des fourneaux, site de recettes, cuisine de chef et vente electroménager",
			"message" => $this->message->showMessages(),
			//"textPopUpCategorie" => $textPopUpCategorie,
			"ajax"=> $codeAjax
			//"recettes" => $viewRecettes
		));
	}

}