<?php

namespace Application\Models;



class ViewListProduits extends \Library\Model\Model{


	public function __construct(){
		parent::__construct();
	}


	public function getViewListProduitsByProduit($idProduit){
		return $this->webserviceRequest("GET", "ViewListProduits", "getViewListProduitsByProduit", array(
				'id_produit' => $idProduit
		));
	}

}

