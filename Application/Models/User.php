<?php

namespace Application\Models;

class User extends \Library\Model\Model{

	protected $table 	= 'user';
	protected $primary 	= 'id';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function login($params){
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'user',				//on peut aussi mettre un tableau(tous ce qu'on vt) pour la valeur de service
							        'method' => 'authentification',
							        'params'=> json_encode($params)
							    )
		    				)
		        )
		);
//
		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}

public function updateUser($id, $password, $params){
	//var_dump($params);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'user',
							        'method' => 'updateuser',
							        'id_user'	=> $id,
							        'password'	=> $password,
							        'params'=> json_encode($params)

							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}




}