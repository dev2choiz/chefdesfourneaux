<?php

namespace Application\Models;



class Categorie extends \Library\Model\Model{

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	/**
	 * @return [array]              [description]
	 */
	public function getCategories(){
		$data =array(
			        'service' 				=> 'categorie',				//on peut aussi mettre un tableau(tous ce qu'on vt) pour la valeur de service
			        'method' 				=> 'getcategories'
	  	);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) );
		
	}


}