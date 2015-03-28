<?php

namespace Application\Models;



class ViewCategorie extends \Library\Model\Modelview{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	/**
	 * [getViewCategorie pour obtenir la view d'une panier]
	 * @param  [int] $idUser [id de la panier]
	 * @return [array] 
	 */
	public function getViewCategorie($idCat){

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewCategorie',				
							        'method' => 'getViewCategorie',
							        'id_cat' => $idCat
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;
	}



}

