<?php

namespace Application\Models;

class User extends \Library\Model\Model{


	public function __construct(){
		parent::__construct();
	}


	public function login($mail, $password){

		return $this->webserviceRequest("GET", "User", "authentification", array(
							        'mail'=> $mail,
							        'password'=>$password
		));

	}

	public function updateUser($id, $mail , $password, $params){
	
		$params['verifmail'] = $mail;
		$params['verifpassword'] = $password;

		return $this->webserviceRequest("PUT", "User", "updateUser",$params);
	}

	public function insertUser($params){
	
		return $this->webserviceRequest("POST", "User", "insertUser",$params);

	}

	public function deleteUser($params){
		return $this->webserviceRequest("DELETE", "User", "deleteUser",$params);
	}



	public function redefinirPassword($mail, $reponse){
		$params['mail']=$mail;
		$params['reponsesecrete']=$reponse;
		return $this->webserviceRequest("POST", "User", "redefinirPassword",$params);	

	}




}