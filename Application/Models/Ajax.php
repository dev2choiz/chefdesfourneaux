<?php

namespace Application\Models;



class Ajax extends \Library\Ajax\Ajax{

	public function __construct(){

	}

	/**
	 * [getAjaxPost description]
	 * @param  [type] $tabInputValue [tableau dont les indices sont "les types de retour" des inputs du ShowDiv, et les valeurs, les ids des inputs correspondants]
	 * @param  [type] $service       [quel service]
	 * @param  [type] $methode       [quelle methode]
	 * @param  [type] $data          [valeurs supplementaires a transmettre au webservice] //ca pourra pt-etre servir
	 * @param  [type] $fonctionName  [nom de la fonction lancé en cas de succes]
	 * @param  [type] $successfonc   [script du success qui lance fonctionName] (tordu non?)
	 * @return [String]                [script ajax qui envoit et lance la $successfonc qui s'appelle $fonctionName]
	 */
	public function getAjaxPost( $tabInputValue, $service, $methode, $data, $fonctionName, $successfonc){

		return $this->getAjax($tabInputValue, "POST", $service, $methode, $data, $fonctionName,  $successfonc);

	}

}

