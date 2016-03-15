<?php

namespace Application\Models;



class ViewRecette extends \Library\Model\Model{


	public function __construct(){
		parent::__construct();
	}


	/**
	 * [getViewRecette pour obtenir la view d'une recette]
	 * @param  [int] $id [id de la recette]
	 * @return [array] 
	 */
	public function getViewRecette($id, $droit='classique'){

		return $this->webserviceRequest("GET", "ViewRecette","getViewRecette",array(
			"id_recette"=>$id,
			'droit'		=> $droit
		));

	}

	/**
	 * Obtenir des views precises
	 * @param  [array] $tabId [tableau d'ids de recettes]
	 * @return [array]	Retourne un tableau (dont les key sont les id des recettes)
	 *                  contenant les views qui sont elles meme des tableaux
	 */
	public function getViewRecettes($tabId, $droit='classique'){
		$tabVR=array();

		foreach ($tabId as $id) {
			$recettes = $this->getViewRecette($id, $droit);
			if($recettes['error']){
				$recettes = false;
			}else{
				$recettes = $recettes['response'];
			}
			$tabVR[$id+''] = $recettes;

		}
		return $tabVR;
	}



	/**
	 * Obtenir toutes les views
	 * @return [array]	Retourne un tableau contenant toutes les views
	 */
	public function getAllViewRecettes( $droit='classique'){

		return $this->webserviceRequest("GET", "ViewRecette","getAllViewRecettes", array("droit"=>$droit));

	}



	/**
	 * getRecherche effectue une recherche dans un champ de la table recette
	 * @param  string $recherche la chaine à rechercher
	 * @param  type $champs    dans quel champ de la table recette on cherche
	 * @return array comme reponse du webservice
	 */
	public function getRecherche($recherche, $champs, $droit='classique'){

		$data =array(
			        'recherche'				=> $recherche,
        			'ou'					=> $champs,
        			'droit'					=> $droit
	  	);
		return $this->webserviceRequest("GET", "Recherche","getRecherche",$data);
	}



	public function getViewRecetteBySlug($slugTitre, $droit='classique'){

		return $this->webserviceRequest("GET", "ViewRecette","getViewRecetteBySlug",array(
			"slugtitre"=>$slugTitre,
			'droit'		=> $droit
		));

	}


}

