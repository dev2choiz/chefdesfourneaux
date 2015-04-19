<?php

namespace Application\Models;



class ListProduit extends \Library\Model\Model{

	

	public function __construct(){
		parent::__construct();
	}



	public function getListProduit( $idRecette){

		$data =array(
			        'service' 				=> 'ListProduit',
			        'method' 				=> 'getListProduit',
			        'id_recette'			=>	$idRecette
	  	);
		//var_dump("samrojtmj",$data);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) )  );
		
	}







	public function insertListProduit( $idRecette, $idProduit){
		$data =array(
			        'service' 				=> 'ListProduit',
			        'method' 				=> 'insertListProduit',
			        'id_recette'			=>	$idRecette,
			        'id_produit'			=>	$idProduit
	  	);
		
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) );
		
	}




	public function deleteListProduit( $idrecette, $idProduit){
		$data =array(
			        'service' 				=> 'ListProduit',
			        'method' 				=> 'deleteListProduit',
			        'id_recette'			=>	$idRecette,
			        'id_produit'			=>	$idProduit
	  	);
		//var_dump("samrojtmj",$data);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) );
		
	}
}