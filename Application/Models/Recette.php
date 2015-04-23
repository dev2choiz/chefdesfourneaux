<?php

namespace Application\Models;



class Recette extends \Library\Model\Model{

	

	

	public function __construct(){
		parent::__construct();
	}


	public function getRecettes(){
		return $this->webserviceRequest("GET", "Recette", "getRecettes", array());
		
	}

	/**
	 * @param  [String] $recette     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertRecette($params, $idUser){
		$params["id_user"] = $idUser;
		return $this->webserviceRequest("POST", "Recette", "insertRecette", $params);
	}



	/**
	 * @param  [String] $recette     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updateRecette($params, $idRecette){
		$params["id_recette"] = $idRecette;
		return $this->webserviceRequest("PUT", "Recette", "updateRecette", $params);
	}



	/**
	 * @param  [String] $recette     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deleteRecette($idRecette){
		$params["id_recette"] = $idRecette;
		return $this->webserviceRequest("DELETE", "Recette", "deleteRecette", $params);	
	}




}