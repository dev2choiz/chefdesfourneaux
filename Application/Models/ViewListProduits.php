<?php

namespace Application\Models;



class ViewListProduits extends \Library\Model\Model{


	public function __construct(){
		parent::__construct();
	}


	public function getViewListProduitsByProduit($idProduit){


		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewListProduits',
							        'method' => 'getViewListProduitsByProduit',
							        'id_produit' => $idProduit
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;

	}

}

