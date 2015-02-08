<?php

namespace Application\Models;

class Properties extends \Library\Model\Model{

	protected $table 	= 'properties';
	protected $primary 	= 'id';


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}
}