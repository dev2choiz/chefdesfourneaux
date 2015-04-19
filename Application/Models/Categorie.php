<?php

namespace Application\Models;



class Categorie extends \Library\Model\Model{

	public function __construct(){
		parent::__construct();
	}


	/**
	 * @return [array]              [description]
	 */
	public function getCategories(){
		$data =array(
			        'service' 				=> 'Categorie',				
			        'method' 				=> 'getCategories'
	  	);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ));
		
	}


}