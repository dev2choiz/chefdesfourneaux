<?php

namespace Library\Model;

abstract class Model{

	private $database;
	protected $table;
	protected $primary;



	/**
	 * Initialise le model
	 * 
	 * @param String $connexionName : nom de la connexion a utiliser
	 * @return  void
	 */
	public function __construct($connexionName){

		$classConnexion = \Library\Model\Connexion::getInstance();
		$this->database = $classConnexion::getConnexion($connexionName);
	}



	/**
	 * [convEnTab description]
	 * @param  [stdclass ou array] $tab [description]
	 * @return [array]      [description]
	 */
	public function convEnTab($tab){


		if(is_object($tab ) ){
			$tab=get_object_vars($tab);
		}
		if(!is_array($tab ) ){
			return $tab;
		}

		foreach ($tab as $key => $value) {

			if(is_array($value ) || is_object($value ) ){
				$tab[$key]=$this->convEnTab($value);
			}
			//$tab[$key]= get_object_vars($value);

		}
		return $tab;
	}












	/**
	 * Reccupere un element en fonction de la clé primaire
	 * 
	 * @param  string/int $value_primary : valeur de la clé primaire à selectionner
	 * @param  string 	  $fields        : liste des champs a selectionner
	 * @return array 					 : tableau d'objet
	 */
	public function findByPrimary($value_primary, $fields="*"){

		$sql = $this->database->prepare("SELECT $fields FROM `{$this->table}` WHERE `{$this->primary}`=:primary");
		$sql->execute(array("primary"=>$value_primary));
		return $sql->fetchAll();
	}


	/**
	 * Reccupere un ou plusieurs element(s) en fonction d'une condition
	 * 
	 * @param  string/int $where 		 : condition pour effectuer la selection (au format SQL)
	 * @param  string 	  $fields        : liste des champs a selectionner
	 * @return array 					 : tableau d'objet(s)
	 */
	public function fetchAll($where=1, $fields="*"){

		$sql = $this->database->prepare("SELECT $fields FROM `{$this->table}` WHERE $where");
		$sql->execute();
		return $sql->fetchAll();
	}


	/**
	 * Effectue une insertion en base
	 * 
	 * $data =array("nom"			=> "value",
	 * 		 		"description" 	=> "value",
	 * 		   		"...."			=> "value");
	 *
	 * listFields = `nom`,`description`,`....`
	 * listValues = :nom,:description,:....
	 *
	 * @param Array $data 
	 * @return Boolean
	 */
	public function insert($data){

		$listFields = '`'.implode('`,`', array_keys($data)).'`';
		$listValues = ':'.implode(',:', array_keys($data));

		$sql = $this->database->prepare("INSERT INTO `{$this->table}` ($listFields) VALUES ($listValues)");
		unset($listFields, $listValues);
		return $sql->execute($data);
	}



	/**
	 * Effectue une mise a jour en base
	 * 
	 * $data =array("id"			=> "value",
	 * 				"nom"			=> "value",
	 * 		 		"description" 	=> "value",
	 * 		   		"...."			=> "value");
	 *
	 * listFieldsValues = `nom`:nom,`description`=:description,`....`=:....
	 *
	 * 
	 * @param string 	$fieldName 	: champ selon lequel la mise a jour sera effectué
	 * @param array 	$data 		: donnée representant l'element
	 * @param boolean 	$strict		: retour strict ou non permet la prise en compte des requetes affectant aucun element 
	 * @return Boolean
	 */
	public function updateByField($fieldName, $data, $strict=true){

		$listFieldsValues = $this->updateListFieldsValues($data, $fieldName);
		$sql = $this->database->prepare("UPDATE `{$this->table}` SET $listFieldsValues WHERE `$fieldName`=:$fieldName");
		unset($listFieldsValues);
		
		$sql->execute($data);
		return $this->returnAffectedRowBoolean($sql, $strict);
	}


	/**
	 * Effectue une mise a jour en base
	 * 
	 * $data =array("id"			=> "value",
	 * 				"nom"			=> "value",
	 * 		 		"description" 	=> "value",
	 * 		   		"...."			=> "value");
	 *
	 * listFieldsValues = `nom`:nom,`description`=:description,`....`=:....
	 *
	 * 
	 * @param string 	$where 		: condition pour effectuer la mise a jour (au format SQL)
	 * @param array 	$data 		: donnée representant l'element
	 * @param boolean 	$strict		: retour strict ou non permet la prise en compte des requetes affectant aucun element 
	 * @return Boolean
	 */
	public function update($where, $data, $strict=true){

		$listFieldsValues = $this->updateListFieldsValues($data);
		$sql = $this->database->prepare("UPDATE `{$this->table}` SET $listFieldsValues WHERE $where");
		unset($listFieldsValues);
		
		$sql->execute($data);
		return $this->returnAffectedRowBoolean($sql, $strict);
	}


	protected function updateListFieldsValues($data, $exclude=null){
		$list = "";
		foreach ($data as $key=>$value) {
			if($exclude==$key){
				continue;
			}
			$list .= "`$key`=:$key,";
		}
		return substr($list, 0, -1);
	}


	/**
	 * Return True ou False en fonction du nombre de ligne affectée
	 * 
	 * @param objectPDO $query  : objectPDO post execution
	 * @param boolean 			: retour strict ou non permet la prise en compte des requetes affectant aucun element
	 * @return Boolean
	 */
	protected function returnAffectedRowBoolean($query, $strict){
		var_dump($query);
		if($query && (($strict && $query->rowCount()>0) || (!$strict && $query->rowCount()>=0))){
			return true;
		}
		return false;
	}



	public function deleteByPrimary($value_primary){

		$sql = $this->database->prepare("DELETE FROM `{$this->table}` WHERE `{$this->primary}`=:primary");		
		$sql->execute(array('primary'=>$value_primary));
		return $this->returnAffectedRowBoolean($sql, true);
	}



	public function delete($where){

		$sql = $this->database->prepare("DELETE FROM `{$this->table}` WHERE $where");		
		$sql->execute();
		return $this->returnAffectedRowBoolean($sql, true);
	}


	


}