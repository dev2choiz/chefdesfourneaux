<?php

namespace Application\Controllers;

class Vente extends \Library\Controller\Controller{

	


	public function __construct(){

		$this->setLayout("carousel");
		//$this->setLayout("blog");
		
	}


	public function indexLivreAction(){
		


		$modelAjax 	= new \Application\Models\AjaxTest('localhost');
		
		$ajax= $modelAjax->getAjax("post", array("service"=>"'viewrecette'", "method"=>"'getAllViewRecettes'"), WEBSERVICE_ROOT.'/index.php', "console.log(data);"  );

		$this->setDataView(array(
			"pageTitle" => "Catégories de recettes, cuisine du monde, recettes authentique, santé, cuisine légère",
			"ajax" => $ajax
			));


	}


	public function livreAction(){
		
	}

	public function restaurantAction(){
		
	}
}