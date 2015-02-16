<?php

namespace Application\Models;



class Recette extends \Library\Model\Model{

	

	

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getRecettes(){
		//http://localhost/Webservice/Public/index.php?service=recette&method=getrecettes
		//echo file_get_contents(WEBSERVICE_ROOT.'/index.php?service=recette&method=getrecettes');
		return json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php?service=recette&method=getrecettes'));
	}

	/**
	 * @param  [String] $recette     [description]
	 * @param  [int] $idUser      [description]
	 * @param  [int] $idCategorie [description]
	 * @return [boolean]              [description]
	 */
	public function insertRecette($params, $idUser){
		$data =array(
			        'service' 				=> 'recette',				//on peut aussi mettre un tableau(tous ce qu'on vt) pour la valeur de service
			        'method' 				=> 'insertrecette',
					"value"					=> $params['value'],		//recette
	  		   		"id_user"				=> $idUser,
	  		   		"id_cat"				=> $params['id_cat'],
	  		   		"id_resto"				=> $params['id_resto'],
	  		   		"id_livre"				=> $params['id_livre']
	  	);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ;
		
	}






}