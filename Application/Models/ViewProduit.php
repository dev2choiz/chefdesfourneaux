<?php

namespace Application\Models;



class ViewProduit extends \Library\Model\Model{


	public function __construct(){
		parent::__construct();
	}


	/**
	 * [getViewProduit pour obtenir la view d'une produit]
	 * @param  [int] $id [id de la produit]
	 * @return [array] 
	 */
	public function getViewProduit($id){
		return $this->webserviceRequest("GET", "ViewProduit", "getViewProduit", array(
							        'id_produit' => $id
		));
	}

	/**
	 * Obtenir des views precises
	 * @param  [array] $tabId [tableau d'ids de produits]
	 * @return [array]	Retourne un tableau (dont les key sont les id des produits)
	 *                  contenant les views qui sont elles meme des tableaux
	 */    //A EFFACER ou à tester
	public function getViewProduits($tabId){
		$tabVR=array();

		foreach ($tabId as $id) {
			$prod8=$this->getViewProduit($id);
			if($prod8['error']){
				$prod8=false;
			}else{
				//echo ($prod8['page'])."<br>";
				$prod8=$prod8['response'];
			}
			//var_dump($prod8);

			$tabVR[$id+'']=$prod8;

		}

		return $tabVR;
		//var_dump($tabVR);
	}



	/**
	 * Obtenir toutes les views
	 * @return [array]	Retourne un tableau contenant toutes les views
	 */
	public function getAllViewProduits(){
		return $this->webserviceRequest("GET", "ViewProduit", "getAllViewProduits", array());
	}


}

