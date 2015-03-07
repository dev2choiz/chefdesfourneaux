<?php

namespace Application\Models;



class ViewListIngredients extends \Library\Model\Model{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getViewListIngredients($idRecette){


		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'viewlistingredients',
							        'method' => 'getviewlistingredients',
							        'id_recette' => $idRecette
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;

	}

}

