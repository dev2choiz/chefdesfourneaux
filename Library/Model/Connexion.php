<?php

namespace Library\Model;

class Connexion {


	use \Library\Traits\Patterns\Singleton;


	/**
	 * Tableau assoc d'object PDO
	 * Chaque object represente une connexion mysql
	 * 
	 * @var array
	 */
	private static $listConnexions;


	public static function getConnexion($name){
		if(!array_key_exists($name, self::$listConnexions)){
			throw new \Exception("Connexion name:'$name' not found");
		}
		return self::$listConnexions[$name];
	}


	public static function getListConnexionsName(){
		return array_keys(self::$listConnexions);
	}


	private function __construct(){

	}

	/**
	 *	Connexion a une base de donnée mysql via PDO
	 * 
	 * @param  String $host     : Adresse du serveur de base de donnée
	 * @param  String $dbname   : Nom de la base de donnée
	 * @param  String $user     : Utilisateur mysql
	 * @param  String $password : Mot de passe de l'utilisateur mysql
	 * @param  string $charset  : Charset de connexion 
	 * @return PDO Object
	 */
	public static function connectDB($host, $dbname, $user, $password, $charset="UTF8"){
		$database = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password);
		$database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
		$database->exec("SET CHARACTER SET $charset");

		return $database;
	}


	/**
	 * Ajoute une nouvelle connnexion a la liste des connexions
	 * 
	 * @param String $connexionName
	 * @param PDO Object 
	 */
	public static function addConnexion($connexionName, $objectPDO){
		self::$listConnexions[$connexionName] = $objectPDO;
	}
}