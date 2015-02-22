<?php

namespace Application\Models;

class User extends \Library\Model\Model{


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

	public function updateUser($id, $mail , $password, $params){		//id ou mail
	
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'user',
							        'method' => 'updateuser',
							        'id_user'	=> $id,
							        'mail'	=> $mail,
							        'password'	=> $password,
							        'params'=> json_encode($params)

							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}

	public function insertUser($params){
	
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'user',
							        'method' => 'insertuser',
							        'params'=> json_encode($params)

							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}

	public function deleteUser($params){
		$params['service']='user';
		$params['method']='deleteuser';
		
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								$params
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}
}