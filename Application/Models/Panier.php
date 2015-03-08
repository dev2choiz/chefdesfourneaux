<?php

namespace Application\Models;



class Panier extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function existeDansPanier($idUser, $idProd){

		$params = array('service' => 'panier',
						'method' => 'existeDansPanier',
						'id_user' => $idUser,
						'id_produit' => $idProd
						 );

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ));
	}

	public function getPanier($idUser){

		$params = array('service' => 'panier',
						'method' => 'getpanier',
						'id_panier' => $idUser );

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ));
	}

	/**
	 * @param  [String] $panier     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertPanier($params){


		//$params["id_user"] = $idUser;
		$params["service"] = "panier";
		$params["method"]  = "insertpanier";

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) );
		
	}



	/**
	 * @param  [String] $panier     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updatePanier($params, $idPanier){
		

		$params["id_panier"] = $idPanier;
		$params["service"] = "panier";
		$params["method"]  = "updatepanier";
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
	 * @param  [String] $panier     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deletePanier($idUser, $idProd){
		

		$params["id_user"] = $idUser;
		$params["id_produit"] = $idProd;
		$params["service"] = "panier";
		$params["method"]  = "deletepanier";


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


public function viderPanier($iUser){
		

		$params["id_user"] = $idUser;
		$params["service"] = "panier";
		$params["method"]  = "viderpanier";


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