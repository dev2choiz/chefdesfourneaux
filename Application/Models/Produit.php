<?php

namespace Application\Models;



class Produit extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getAllProduits(){

		$params = array('service' => 'produit',
						'method' => 'getallproduits' );

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

	public function getProduit($idRecette){

		$params = array('service' => 'produit',
						'method' => 'getproduit',
						'id_produit' => $idRecette );

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
	 * @param  [String] $produit     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertProduit($params){


		//$params["id_user"] = $idUser;
		$params["service"] = "produit";
		$params["method"]  = "insertproduit";

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
	 * @param  [String] $produit     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updateProduit($params, $idProduit){
		

		$params["id_produit"] = $idProduit;
		$params["service"] = "produit";
		$params["method"]  = "updateproduit";
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
	 * @param  [String] $produit     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deleteProduit($idProduit){
		

		$params["id_produit"] = $idProduit;
		$params["service"] = "produit";
		$params["method"]  = "deleteproduit";


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