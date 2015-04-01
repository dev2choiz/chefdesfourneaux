<?php

namespace Application\Models;

class User extends \Library\Model\Model{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function login($mail, $password){
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'User',				
							        'method' => 'authentification',
							        'mail'=> $mail,
							        'password'=>$password
							    )
		    				)
		        )
		);
//
		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}

	public function updateUser($id, $mail , $password, $params){
	

		$params['service'] = 'User';
		$params['method'] = 'updateUser';
		$params['verifid_user'] = $id;
		$params['verifmail'] = $mail;
		$params['verifpassword'] = $password;
		//var_dump("modeluser",$params);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query( $params )
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}

	public function insertUser($params){
	

		$params['service']='User';
		$params['method']='insertUser';
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query( $params )
		        )
		);

		$context  = stream_context_create($opts);
		return  json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ;
	}

	public function deleteUser($params){
		$params['service']='User';
		$params['method']='deleteUser';
		
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



	public function redefinirPassword($mail, $reponse){
		$params['service']='User';
		$params['method']='redefinirPassword';
		$params['mail']=$mail;
		$params['reponsesecrete']=$reponse;
		

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