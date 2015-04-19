<?php

namespace Application\Models;



class QuestionSecrete extends \Library\Model\Model{

	public function __construct(){
		parent::__construct();
	}


	/**
	 * @return [array]              [description]
	 */
	public function getQuestionSecretes(){
		return $this->webserviceRequest("GET", "QuestionSecrete", "getQuestionSecretes", array());
	}


	/**
	 * @return [array]              [description]
	 */
	public function getUserQuestionSecrete($idQuestRep){
		return $this->webserviceRequest("GET", "QuestionSecrete", "getQuestionSecrete", array(
				'id_questionsecrete' 				=> $idQuestRep
		));
	}






}