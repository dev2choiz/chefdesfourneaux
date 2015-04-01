<?php

namespace Library\Loader;
require_once(str_replace('Loader', 'Traits/Patterns/Singleton.php', __DIR__));


class Autoloader
{
	
	/**
	 * Notre class devient un singleton grace à l'utilisation du Trait Singleton
	 */
	use \Library\Traits\Patterns\Singleton;



	private static $basePath = null;



	/**
	 * Setter basePath
	 *
	 * @param string $path  chemin du projet (c:\wamp\www\...)
	 * @return void
	 * 
	 * @example $class::setBasePath("c:\wamp\www\recette")
	 */
	public static function setBasePath($path){
		self::$basePath = $path;
	}


	private function __construct(){
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}


	/**
	 * Autoloader
	 * 
	 * @param  string $class
	 * @return void      
	 */
	protected static function autoload($class){

		if(is_null(self::$basePath)){
			throw new \Exception("basePath in" . __CLASS__ . " is Null");
		}

		$pathFile = self::$basePath . str_replace('\\', DIRECTORY_SEPARATOR, $class) . ".php";
		require_once($pathFile);
		
	}
	
}