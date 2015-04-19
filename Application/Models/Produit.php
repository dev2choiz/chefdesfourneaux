<?php

namespace Application\Models;



class Produit extends \Library\Model\Model{

	

	

	public function __construct(){
		parent::__construct();
	}


	public function getAllProduits(){
		return $this->webserviceRequest("GET", "Produit", "getAllProduits", array());
	}

	public function getProduit($idProd){
		return $this->webserviceRequest("GET", "Produit", "getProduit", array(
			'id_produit' => $idProd
		));

	}

	/**
	 * @param  [String] $produit     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertProduit($params){

		return $this->webserviceRequest("POST", "Produit", "insertProduit",$params);

	}



	/**
	 * @param  [String] $produit     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function updateProduit($params, $idProduit){
		$params=array();
		$params["id_produit"] = $idProduit;
		return $this->webserviceRequest("PUT", "Produit", "updateProduit",$params);
	}



	/**
	 * @param  [String] $produit     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function deleteProduit($idProduit){
		$params=array();
		$params["id_produit"] = $idProduit;
		return $this->webserviceRequest("DELETE", "Produit", "deleteProduit", $params);
	}




}