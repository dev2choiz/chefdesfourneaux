<?php

namespace Application\Controllers;

class Index extends \Library\Controller\Controller
{
	
	public function __construct(){
		parent::__construct();
		//$this->setLayout("carousel");
		$this->setLayout("blog");
	}


	public function indexAction(){

	}

}