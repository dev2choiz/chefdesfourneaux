<?php

namespace Application\Models;



class Mailer extends \Library\Model\Model{

	

	

	public function __construct(){
		parent::__construct();
	}


	public function envoyerMail($mailExped, $mailDest, $body, $subject, $template){

		$params = array('service' 		=> 'panier',
						'method' 		=> 'existeDansPanier',
						'expediteur' 	=> $idUser,
						'destinataire' 	=> $idPanier,
						'body'			=> $body,
						'subject'		=> $subject,
						'template'		=> $template
						 );

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => http_build_query($params)
		        )
		);

		$context  = stream_context_create($opts);
		
		return $this->convEnTab(json_decode(file_get_contents(WEBSERVICE_ROOT.'/index.php', false, $context) ));
	}


}