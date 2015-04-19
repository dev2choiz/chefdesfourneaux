<?php

namespace Library\Model;

abstract class Modelview extends Model{


	public function __construct(){
		parent::__construct();
	}

	public function delete($where){
		throw new \Exception("Error DELETE impossible sur une view");	
	}

	public function deleteByPrimary($value_primary){
		throw new \Exception("Error DELETE impossible sur une view");	
	}

	public function insert($data){
		throw new \Exception("Error INSERT impossible sur une view");	
	}
}