<?php

namespace Application\Models;



class ViewListIngredients extends \Library\Model\Model{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	public function getViewListIngredients(){
		return json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php?service=&method='));
	}

}

