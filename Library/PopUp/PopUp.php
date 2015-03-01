<?php

namespace Library\PopUp;

abstract class PopUp extends \Library\Ajax\Ajax{

	

	public function __construct(){

	}

	public function getAjaxPost( $service, $methode, $data, $functionName){

		return $this->getAjax( "POST", $service, $methode, $data, $functionName);

	}

	public function getScriptPopUp($idDiv, $service, $methode, $data, $functionName){

		return"

		<script type='text/javascript'>
				$(document).ready(function(){
					$('#$idDiv')
						.click(function(){
							$('#popupContainer').css('display', 'block');
							$('#popup').css('display', 'block');	
							$functionName();
						});

					$('#popupContainer').click(function(){
						$('#popupContainer').css('display', 'none');
						$('#popup').css('display', 'none');
					});
				});
				{$this->getAjax( "POST", $service, $methode, $data, $functionName)};
		</script>
		";
	}

	public function getHtmlPopUp($titre, $value, $type){
		return
		"
		
		<div id='popupContainer' style='display:none;'>

			<div id='popup' style='display:none;'>
				<select id='popupSelect'></select>
				<div id='row'>
					<span>Ajout $titre</span>
				
					<div id='inputPopUp'>
						<label name='value'>$value : </label>
						<input type='text' name='value' id='value' required>
					</div>

					<button name='btn' class='btn btn-lg btn-primary' type='submit'>Valider l'ajout de $type</button>
				</div>
			</div>
		</div>";
	}


}