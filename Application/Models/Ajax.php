<?php

namespace Application\Models;



class Ajax extends \Library\Ajax\Ajax{

	public function __construct(){

	}

	
	public function getAjaxPost( $service, $methode, $data, $fonctionName, $successfonc){

		return $this->getAjax( "POST", $service, $methode, $data, $fonctionName,  $successfonc);

	}

}

