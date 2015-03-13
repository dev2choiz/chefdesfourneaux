<?php

namespace Library\Model;

abstract class Model{


	/**
	 * Initialise le model
	 * @return  void
	 */
	public function __construct(){

	}



	/**
	 * [convEnTab converti les objets et sous objets en tableau]
	 * @param  [stdclass ou array] $tab
	 * @return [array]
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


	public function isConnect(){
		return empty($_SESSION['user'] )?false:true;
	}

}