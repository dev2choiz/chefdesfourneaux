<?php

namespace Library\Traits\Patterns;

trait Singleton {


	private static $instance = null;

	/**
	 * Récupère l'instance de la class
	 * @return Object SingletonClass
	 */
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}
}