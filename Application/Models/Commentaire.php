<?php

namespace Application\Models;



class Commentaire extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getCommentaires($idRecette){

		$params["id_recette"] = $idRecette;
		$params["service"] = "commentaire";
		$params["method"]  = "getcommentaires";

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
	public function insertCommentaire($params){


		$params["service"] = "commentaire";
		$params["method"]  = "insertcommentaire";

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
		$params["service"] = "commentaire";
		$params["method"]  = "updatecommentaire";
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
		$params["service"] = "commentaire";
		$params["method"]  = "deletecommentaire";


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