<?php

namespace Library\Message;

class Message{



	public function __construct(){
		if(!isset($_SESSION)){
			session_start();
		}
	}

	public function addError($message){
		$_SESSION["message"]["error"][] = $message;
	}

	public function addWarning($message){
		$_SESSION["message"]["warning"][] = $message;
	}

	public function addSuccess($message){
		$_SESSION["message"]["success"][] = $message;
	}


	public function getMessages($filter="all"){
		
		if(empty($_SESSION["message"])){
			return array();
		}

		if($filter==="all"){
			return $_SESSION["message"];
		}else{			
			$filter = strtolower($filter);
			if(array_key_exists($filter, $_SESSION["message"])){
				return $_SESSION["message"][$filter];
			}
		}
		return array();
	}

	/*
	public function existMessage($filter="all"){
		$r = $this->getMessages($filter);
		if(empty($r)){
			return false;
		}
		return true;
	}
	*/




	public function showMessages(){
		
		$html = "";

		if(!empty($_SESSION["message"]["error"])){

			$html .= "<div class='alert alert-danger'>
						<p>
							<span class='glyphicon glyphicon-warning-sign'></span> Error
							<hr />
						</p>"
							. implode('<br />', $_SESSION["message"]["error"]) .
					"</div>";
		}

		if(!empty($_SESSION["message"]["warning"])){

			$html .= "<div class='alert alert-warning'>
						<p>
							<span class='glyphicon glyphicon-warning-sign'></span> Warning
							<hr />
						</p>"
							. implode('<br />', $_SESSION["message"]["warning"]) .
					"</div>";
		}

		if(!empty($_SESSION["message"]["success"])){

			$html .= "<div class='alert alert-success'>
						<p>
							<span class='glyphicon glyphicon-ok'></span> Success
							<hr />
						</p>"
							. implode('<br />', $_SESSION["message"]["success"]) .
					"</div>";
		}

		$_SESSION['message'] = array();
		return $html;
	}
}