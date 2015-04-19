<?php

namespace Application\Models;



class Categorie extends \Library\Model\Model{

	public function __construct(){
		parent::__construct();
	}


	/**
	 * recupere toutes les catégories 
	 * @return array conteant la reponse
	 */
	public function getCategories(){
		return $this->webserviceRequest("GET", "Categorie","getCategories",array());
	}


}