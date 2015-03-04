<?php

namespace Library\PopUp;

abstract class PopUp extends \Library\Ajax\Ajax{

	

	public function __construct(){

	}


	public function getHtmlButtonPopup($idButtonPopup, $value){
		return "<input type='button' value='$value' id='$idButtonPopup' >";
		
	}



	public function getScriptPopup($idDiv, $scriptAjax, $functionName){


		return "
		<script type='text/javascript'>
				$(document).ready(function(){

					$('#$idDiv')
						.click(function(){
							/*if( $('#popupContainer').css('display') == 'block' ){
								$('#popupContainer').css('display', 'none');
								$('#inputPopup').css('display', 'none');
							}else{
								$('#popupContainer').css('display', 'block');	
								$('#inputPopup').css('display', 'block');
							}*/
							$('#popupContainer').css('display', 'block');	
							$('#inputPopup').css('display', 'block');
						});

					$('#inputPopup')
						.click(function(){
							$('#inputPopup').css('display', 'block');
						})

					$('#btnCancel')
						.click(function(){
							$('#popupContainer').css('display', 'none');
							$('#inputPopup').css('display', 'none');
						})

					

					$('#BtnPopup').click(function(){
						{$functionName}();
					});





					/*$('#BtnPopup').submit(function(e){t
					    e.preventDefault();
					 
					 });

					$('#popupContainer').click(function(){
					$('#popupContainer').css('display', 'none');
					});*/   
				});
				
				$scriptAjax
				
		</script>
		";
	}



	public function getHtmlPopup($titre, $value, $type, $input = NULL){
		return
		"
		<div id='popupContainer'>

			<span>Ajout $titre</span-->
		
			<div id='inputPopup'>
				<label name='labelValue' id='labelValue'>$value : </label>
				<input type='text' name='value' id='value' class='inputTextPopup'>
				<input type='text' name='prix' id='prix' class='inputTextPopup'>
				<input type='text' name='ref' id='ref' class='inputTextPopup'>
				$input

				<input  class='btn btn-cancel' id='btnCancel' value='Annuler' >
				<input id='BtnPopup' class='btn btn-primary' value='Valider l ajout de $type'>

			<!--button name='btnPopup' class='btn btn-primary'>Valider l'ajout de $type</button-->
			</div>
		</div>";
	}





}

	

	//return $this->getAjaxPost(  $service, $methode, $data, $functionName);
	

/*
	public function getScriptPopUp($idDiv, $scriptAjax){		//$service, $methode, $data, $functionName){

		return "
		<script type='text/javascript'>
				$(document).ready(function(){
					$('#$idDiv')
						.click(function(){
							$('#popupContainer').css('display', 'block');
							$('#popup').css('display', 'block');	
							
						});

					$('#popupContainer').click(function(){
						$('#popupContainer').css('display', 'none');
						$('#popup').css('display', 'none');
					});
				});
				
				$scriptAjax
				
		</script>
		";
		//{$this->getAjaxPost( $service, $methode, $data, $functionName, 'console.log(data);'  )};
		
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
*/