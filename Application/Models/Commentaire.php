<?php

namespace Application\Models;



class Commentaire extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getCommentaires($idRecette){

		//$params["id_recette"] = $idRecette;
		return $this->webserviceRequest("GET", "Commentaire","getCommentaires",array(
			"id_recette"=>$idRecette
		));
	}

	/**
	 * @param  [String] $commentaire     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertCommentaire($params){

		return $this->webserviceRequest("POST", "Commentaire", "insertCommentaire", $params);		
		
	}



	/**
	 * @param  [String] $commentaire     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updateCommentaire($params, $idCommentaire){
		$params["id_commentaire"] = $idCommentaire;
		return $this->webserviceRequest("PUT", "Commentaire", "updateCommentaire", $params);
		
	}



	/**
	 * @param  [String] $commentaire     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deleteCommentaire($idCommentaire){
		

		$params["id_commentaire"] = $idCommentaire;
		return $this->webserviceRequest("PUT", "Commentaire", "deleteCommentaire", $params);
	}




}