<?php

namespace Application\Models;



class ViewListIngredients extends \Library\Model\Model{


	public function __construct(){
		parent::__construct();
	}


	public function getViewListIngredients($idRecette){

		return $this->webserviceRequest("GET", "ViewListIngredients", "getViewListIngredients", array(
				'id_recette' => $idRecette
		));

	}

}

