<?php

namespace Application\Models;



class Ingredient extends \Library\Model\Model{

	

	public function __construct(){
		parent::__construct();
	}


	/**
	 * @return [array]              [description]
	 */
	public function getIngredients(){
		$data =array(
			        'service' 				=> 'Ingredient',
			        'method' 				=> 'getIngredients'
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



	//??????? ne sert a rien ????????
	public function insertIngredients($tabIngred, $recette){
		$data =array(
			        'service' 				=> 'Ingredient',
			        'method' 				=> 'insertIngredients',
			        'ingredients'			=>	json_encode($tabIngred),
			        'id_recette'			=>	$recette
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