<?php

namespace Application\Models;

class Viewjeux extends \Library\Model\Modelview{

	protected $table 	= 'viewjeux';
	protected $primary 	= 'id';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}
}