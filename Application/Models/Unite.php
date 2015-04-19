<?php

namespace Application\Models;



class Unite extends \Library\Model\Model{

	

	public function __construct(){
		parent::__construct();
	}


	/**
	 * @return [array]              [description]
	 */
	public function getUnites(){
		return $this->webserviceRequest("GET", "Unite", "getUnites", array());
	}


}