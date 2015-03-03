<?php

namespace Application\Models;



class Ajax extends \Library\Ajax\Ajax{

	public function __construct(){

	}

	
	public function getAjaxPost( $tabInputValue, $service, $methode, $data, $fonctionName, $successfonc){

		return $this->getAjax($tabInputValue, "POST", $service, $methode, $data, $fonctionName,  $successfonc);

	}

}

