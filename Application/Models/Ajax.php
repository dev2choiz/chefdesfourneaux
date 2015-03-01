<?php

namespace Application\Models;



class Ajax extends \Library\Ajax\Ajax{

	public function __construct($connexionName){
		parent::__construct($connexionName);
	}

	
	public function getAjaxPost( $service, $methode, $data, $fonctionName, $successFunc ){

		return $this->getAjax( "POST", $service, $methode, $data, $fonctionName, $successFunc );

	}

}

