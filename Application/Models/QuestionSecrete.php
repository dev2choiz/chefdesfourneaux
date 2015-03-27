<?php

namespace Application\Models;



class QuestionSecrete extends \Library\Model\Model{

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	/**
	 * @return [array]              [description]
	 */
	public function getQuestionSecretes(){
		$data =array(
			        'service' 				=> 'questionsecrete',				
			        'method' 				=> 'getquestionsecretes'
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


	/**
	 * @return [array]              [description]
	 */
	public function getUserQuestionSecrete($idUser){
		$data =array(
			        'service' 				=> 'questionsecrete',				
			        'method' 				=> 'getquestionsecretes',
			        'id_user' 				=> $idUser
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