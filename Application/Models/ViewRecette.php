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
		        'method'  => 'POST',
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
			$re7=$this->getViewRecette($id);
			if($re7['error']){
				$re7=false;
			}else{
				echo ($re7['page'])."<br>";
				$re7=$re7['response'];
			}
			//var_dump($re7);

			$tabVR[$id+'']=$re7;

		}

		return $tabVR;
		//var_dump($tabVR);
	}



	/**
	 * Obtenir toutes les views
	 * @return [array]	Retourne un tableau contenant toutes les views
	 */
	public function getAllViewRecettes(){

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
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

	}


}

