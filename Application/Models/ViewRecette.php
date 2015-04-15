<?php

namespace Application\Models;



class ViewRecette extends \Library\Model\Model{


	public function __construct($connexionName){
		parent::__construct($connexionName);
	}


	/**
	 * [getViewRecette pour obtenir la view d'une recette]
	 * @param  [int] $id [id de la recette]
	 * @return [array] 
	 */
	public function getViewRecette($id){

		$opts = array('http' =>
		    array(
		        'method'  => 'GET',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewRecette',				
							        'method' => 'getViewRecette',
							        'id_recette' => $id
							    )
		    				)
		        )
		);

		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;
	}

	/**
	 * Obtenir des views precises
	 * @param  [array] $tabId [tableau d'ids de recettes]
	 * @return [array]	Retourne un tableau (dont les key sont les id des recettes)
	 *                  contenant les views qui sont elles meme des tableaux
	 */
	public function getViewRecettes($tabId){
		$tabVR=array();

		foreach ($tabId as $id) {
			$recettes = $this->getViewRecette($id);
			if($recettes['error']){
				$recettes = false;
			}else{
				echo ($recettes['page'])."<br>";
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
	public function getAllViewRecettes(){

		$opts = array('http' =>
		    array(
		        'method'  => 'GET',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query(
								array(
							        'service' => 'ViewRecette',				
							        'method' => 'getAllViewRecettes',
							    )
		    				)
		        )
		);
		
		$context  = stream_context_create($opts);
		return  $this->convEnTab(json_decode( file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ) ) ;
		//$this->webserviceRequest('GET', 'ViewRecette', 'getAllViewRecettes', array());

	}



	/**
	 * @return [array]              [description]
	 */
	public function getRecherche($recherche, $champs){
		$data =array(
			        'service' 				=> 'Recherche',				
			        'method' 				=> 'getRecherche',
			        'recherche'				=> $recherche,
        			'ou'					=> $champs
	  	);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($data)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ));
		
	}


}

