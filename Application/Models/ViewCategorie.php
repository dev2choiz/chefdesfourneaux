<?php

namespace Application\Models;



class ViewCategorie extends \Library\Model\Modelview{


	public function __construct(){
		parent::__construct();
	}


	/**
	 * [getViewCategorie pour obtenir la view d'une panier]
	 * @param  [int] $idUser [id de la panier]
	 * @return [array] 
	 */
	public function getViewCategorie($idCat){
		return $this->webserviceRequest("GET", "ViewCategorie", "getViewCategorie", array(
				'id_cat' 				=> $idCat
		));
	}



}

