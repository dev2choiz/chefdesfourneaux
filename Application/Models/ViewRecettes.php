<?php

namespace Application\Models;



class ViewRecettes extends \Library\Model\Model{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getViewRecettes(){
		return json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php?service=viewrecette&method=getviewrecettes'));
	}

}

