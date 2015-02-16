<?php

namespace Library\Model;

abstract class Model{


	/**
	 * Initialise le model
	 * 
	 * @param String $connexionName : nom de la connexion a utiliser
	 * @return  void
	 */
	public function __construct(){

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
}