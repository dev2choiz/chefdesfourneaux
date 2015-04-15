<?php

namespace Application\Models;



class Commentaire extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getCommentaires($idRecette){

		//$params["id_recette"] = $idRecette;
		$this->webserviceRequest("Commentaire","getCommentaires",array("id_recette", $idRecette));
	}

	/**
	 * @param  [String] $commentaire     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertCommentaire($params){


		$params["service"] = "Commentaire";
		$params["method"]  = "insertCommentaire";

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) );
		
	}



	/**
	 * @param  [String] $commentaire     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updateCommentaire($params, $idCommentaire){
		

		$params["id_commentaire"] = $idCommentaire;
		$params["service"] = "Commentaire";
		$params["method"]  = "updateCommentaire";
//var_dump("dan model",$params);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) );
		
	}



	/**
	 * @param  [String] $commentaire     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deleteCommentaire($idCommentaire){
		

		$params["id_commentaire"] = $idCommentaire;
		$params["service"] = "Commentaire";
		$params["method"]  = "deleteCommentaire";


		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) );
		
	}




}