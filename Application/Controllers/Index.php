<?php

namespace Application\Controllers;

class Index extends \Library\Controller\Controller
{
	
	public function __construct(){
		parent::__construct();
	}


	public function indexAction(){

	}


	public function test1Action($id=0){
		$id = (int) $id;
		$listJeux = new \Application\Models\Jeux('localhost');
		$listJeux = $listJeux->findByPrimary($id);

		$this->setDataView(array("listJeux"=>$listJeux));
	}


	public function test2Action(){

		$listJeux = new \Application\Models\Viewjeux('localhost');

	/*
		var_dump($listJeux->insert(array("id_support"	=> 1,
										 "id_genre"		=> 3,
										 "id_age"		=> 5,
										 "nom"			=> "new game test 1",
										 "description"	=> "description")));
	*/
	
	/*
		var_dump($listJeux->update("`id`=:id", array("id"	=> 7,
													 "nom"	=> "jeux 7777")));
	
	*/	
	//	var_dump($listJeux->delete("`id`=7"));

		$listJeux = $listJeux->fetchAll();
		$this->setDataView(array("listJeux"=>$listJeux));
	}
}