<?php

namespace Application\Models;



class ViewPanier extends \Library\Model\Modelview{


	public function __construct(){
		parent::__construct();
	}


	/**
	 * [getViewPanier pour obtenir la view d'une panier]
	 * @param  [int] $idUser [id de la panier]
	 * @return [array] 
	 */
	public function getViewPanierByUser($idUser){
		return $this->webserviceRequest("GET", "ViewPanier", "getViewPanier", array(
			'id_user' => $idUser
		));

	}



}

