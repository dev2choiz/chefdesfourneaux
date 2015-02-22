<?php

namespace Application\Controllers;

class Index extends \Library\Controller\Controller
{
	private $message;
	private $tinyMCE;
	private $modelViewRecettes;
	
	public function __construct(){
		parent::__construct();
		$this->setLayout("carousel");
		$this->message 				= new \Library\Message\Message();
		$this->tinyMCE 				= new \Library\TinyMCE\tinyMCE();
		$this->modelViewRecettes 	= new \Application\Models\ViewRecettes('localhost');
	}


	public function indexAction(){
		echo "<br><br><br>";
		echo "<br><br><br>";

		 
		$viewRecettes 		= $this->modelViewRecettes->getAllViewRecettes() ;
		if(!$viewRecettes['error']){
			$viewRecettes=$viewRecettes['response'];
			//var_dump("##################################", $viewRecettes);
		}
		

		$viewRecettes 		= $this->modelViewRecettes->getViewRecette() ;


		$this->setDataView(array(
			"pageTitle" => "Maitres des fourneaux, site de recettes, cuisine de chef et vente electroménager",
			"message" => $this->message->showMessages()//,
			//"recettes" => $viewRecettes
		));
	}

}