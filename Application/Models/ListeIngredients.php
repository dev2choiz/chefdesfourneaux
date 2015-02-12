<?php

namespace Application\Models;



class Ingredient extends \Library\Model\Model{

	protected $table 	= 'ingredients';
	protected $primary 	= 'id_ingredient';

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	/**
	 * @return [array]              [description]
	 */
	public function getIngredients(){
		$data =array(
			        'service' 				=> 'ingredient',
			        'method' 				=> 'getingredients'
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

	public function insertListeIngredients($tabIngreds, unites, $recette){
		$data =array(
			        'service' 				=> 'listeingredient',
			        'method' 				=> 'insertingredients',
			        'ingredients'			=>	json_encode($tabIngreds),
			        'unites'				=>	json_encode($unites),
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