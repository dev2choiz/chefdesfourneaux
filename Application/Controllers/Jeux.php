<?php
//a supprimer
namespace Application\Controllers;

class Jeux extends \Library\Controller\Controller{

	private $modelViewJeux;
	private $modelJeux;
	private $modelProperties;


	public function __construct(){

		$this->modelViewJeux 	= new \Application\Models\Viewjeux('localhost');
		$this->modelJeux 		= new \Application\Models\Jeux('localhost');
		$this->modelProperties 	= new \Application\Models\Properties('localhost');
	}


	public function indexAction(){
		$listeJeux = $this->modelViewJeux->fetchAll();
		$pageTitle = "Liste Jeux";
		$this->setDataView(compact("listeJeux", "pageTitle"));
	}


	public function readAction($id){
		$id = (int) $id;
		$listeJeux = $this->modelViewJeux->findByPrimary($id);
		$jeuTitle  = (!empty($listeJeux[0]))?" : ".$listeJeux[0]->nom:"";
		$pageTitle = "Detail jeu $jeuTitle";
		$this->setDataView(compact("listeJeux", "pageTitle"));
	}




	public function createAction(){
		

	}


	public function updateAction($id){
		

	}


	public function deleteAction($id){
		

	}
}