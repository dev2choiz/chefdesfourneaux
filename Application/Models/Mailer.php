<?php

namespace Application\Models;



class Mailer extends \Library\Model\Model{

	

	

	public function __construct(){
		parent::__construct();
	}


	public function envoyerMail($mailExped, $mailDest, $body, $subject, $template){
		return $this->webserviceRequest("POST", "Mail","envoyerMail",array(
						'expediteur' 	=> $idUser,
						'destinataire' 	=> $idPanier,
						'body'			=> $body,
						'subject'		=> $subject,
						'template'		=> $template
		));

	}


}