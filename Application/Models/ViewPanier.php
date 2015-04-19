<?php

namespace Application\Models;



class ViewPanier extends \Library\Model\Modelview{


	public function __construct(){
		parent::__construct();
	}


	/**
	 * [getViewPanier pour obtenir la view d'une panier]
	 * @param  [int] $idUser [id de la panier]
	 * @return [array] 
	 */
	public function getViewPanierByUser($idUser){

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewPanier',				
							        'method' => 'getViewPanier',
							        'id_user' => $idUser
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;
	}



}

