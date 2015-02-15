<?php

namespace Application\Models;



class ListeIngredients extends \Library\Model\Model{

	protected $table 	= 'ingredients';
	protected $primary 	= 'id_ingredient';

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}




	public function insertListeIngredients($tabIngreds, $unites, $idrecette, $quantites){
		$data =array(
			        'service' 				=> 'listeingredients',
			        'method' 				=> 'insertlisteingredients',
			        'ingredients'			=>	json_encode($tabIngreds),
			        'unites'				=>	json_encode($unites),
			        'id_recette'			=>	$idrecette,
			        'quantites'				=>	json_encode($quantites)
	  	);
		var_dump("samrojtmj",$data);
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