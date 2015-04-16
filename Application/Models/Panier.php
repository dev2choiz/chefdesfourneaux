<?php

namespace Application\Models;



class Panier extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function existeDansPanier($idUser, $idPanier){

		$params = array(
			'id_user' => $idUser,
			'id_panier' => $idPanier
		);
		return $this->webserviceRequest("GET", "Panier","existeDansPanier",$params);
		
	}

	public function getPanier($idUser){

		$params = array( 'id_panier' => $idUser );
		return $this->webserviceRequest("GET", "Panier","getPanier",$params);
		
	}

	/**
	 * @param  [String] $panier     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertPanier($params){
		return $this->webserviceRequest("POST", "Panier","insertPanier",$params);
	}



	/**
	 * @param  [String] $panier     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updatePanier($params, $idPanier){
		
		$params["id_panier"] = $idPanier;
		return $this->webserviceRequest("PUT", "Panier", "insertPanier", $params);
		
	}



	/**
	 * @param  [String] $panier     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deletePanier($idUser, $idPanier){
		

		$params["id_user"] = $idUser;
		$params["id_panier"] = $idPanier;
		

		return $this->webserviceRequest("DELETE", "Panier", "deletePanier", $params);
		
	}


public function viderPanier($iUser){
		
		$params["id_user"] = $idUser;

		return $this->webserviceRequest("DELETE", "Panier", "viderPanier", $params);
		
	}


}