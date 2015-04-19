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

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewProduit',				
							        'method' => 'getViewProduit',
							        'id_produit' => $id
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;
	}

	/**
	 * Obtenir des views precises
	 * @param  [array] $tabId [tableau d'ids de produits]
	 * @return [array]	Retourne un tableau (dont les key sont les id des produits)
	 *                  contenant les views qui sont elles meme des tableaux
	 */
	public function getViewProduits($tabId){
		$tabVR=array();

		foreach ($tabId as $id) {
			$prod8=$this->getViewProduit($id);
			if($prod8['error']){
				$prod8=false;
			}else{
				echo ($prod8['page'])."<br>";
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

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewProduit',				
							        'method' => 'getAllViewProduits',
							    )
		    				)
		        )
		);
		
		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;

	}


}

