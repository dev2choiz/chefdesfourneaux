<?php

namespace Application\Models;



class ListIngredients extends \Library\Model\Model{

	

	public function __construct(){
		parent::__construct();
	}




	public function insertListIngredients($tabIngreds, $unites, $idrecette, $quantites){
		return $this->webserviceRequest("POST", "ListIngredients","insertListIngredients",array(
	        'ingredients'			=>	json_encode($tabIngreds),
	        'unites'				=>	json_encode($unites),
	        'id_recette'			=>	$idrecette,
	        'quantites'				=>	json_encode($quantites)
		));
	}




	public function updateListIngredients($tabIngreds, $unites, $idrecette, $quantites){
		return $this->webserviceRequest("PUT", "ListIngredients","updateListIngredients",array(
	        'ingredients'			=>	json_encode($tabIngreds),
	        'unites'				=>	json_encode($unites),
	        'id_recette'			=>	$idrecette,
	        'quantites'				=>	json_encode($quantites)
		));
	}
}