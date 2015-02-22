<?php

namespace Application\Models;



class ViewRecettes extends \Library\Model\Model{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getViewRecette($id){

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'viewrecette',				//on peut aussi mettre un tableau(tous ce qu'on vt) pour la valeur de service
							        'method' => 'getviewrecettes',
							        'id_recette'=> $id
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;

	}

}

