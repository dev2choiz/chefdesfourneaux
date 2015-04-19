<?php

namespace Application\Models;



class ListProduit extends \Library\Model\Model{

	

	public function __construct(){
		parent::__construct();
	}



	public function getListProduit( $idRecette){
		return $this->webserviceRequest("GET", "ListProduit","getListProduit",array(
			'id_recette' =>	$idRecette
		));
	}







	public function insertListProduit( $idRecette, $idProduit){
		return $this->webserviceRequest("POST", "ListProduit","insertListProduit",array(
			        'id_recette'			=>	$idRecette,
			        'id_produit'			=>	$idProduit
		));
	}




	public function deleteListProduit( $idrecette, $idProduit){
		return $this->webserviceRequest("DELETE", "ListProduit","deleteListProduit",array(
			        'id_recette'			=>	$idRecette,
			        'id_produit'			=>	$idProduit
		));
	}
}