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

		foreach ( $tab as $key => $value ) {

			if(is_array($value ) || is_object($value ) ){
				$tab[$key]=$this->convEnTab($value);
			}

		}
		return $tab;
	}


	public function isConnected(){
		return empty($_SESSION['user'] )?false:true;
	}



    /*public function retirerCaractereSpeciaux($chaine){
        $chaine = mb_strtolower($chaine, 'UTF-8');
        return str_replace(     '@ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                                'aAAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy',
                                $chaine);
 
    }*/




    public function retirerCaractereSpeciaux($str, $charset='utf-8'){
        //echo $str."<br>";
        $str = htmlentities($str, ENT_NOQUOTES, $charset);
        //echo $str."<br>";
        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        //echo $str."<br>";
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
        //echo $str."<br>";
        //$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
    return $str;
    }

}