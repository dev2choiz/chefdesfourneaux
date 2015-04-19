<?php

namespace Application\Models;



class Ingredient extends \Library\Model\Model{

	

	public function __construct(){
		parent::__construct();
	}


	/**
	 * @return [array]              [description]
	 */
	public function getIngredients(){
		return $this->webserviceRequest("GET", "Ingredient","getIngredients",array());
		
	}



	//??????? ne sert a rien ????????
	public function insertIngredients($tabIngred, $recette){
		return $this->webserviceRequest("POST", "Ingredient","insertIngredients",array(
			    'ingredients'			=>	json_encode($tabIngred),
			    'id_recette'			=>	$recette
		));
		
	}


}