<?php

namespace Application\Modules;

class Test extends \Library\Controller\Controller{


	public function __construct(){
		parent::__construct();
	}


	public function indexAction(){
		
	}

	public function listeAction($param1, $param2){
		$rows = array();
		for($i=0; $i<$param2; $i++){
			array_push($rows,"$param1-$i");
		}
		$this->setDataMod(array('listuser'=>$rows));
	}
}