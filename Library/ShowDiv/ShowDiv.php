<?php

namespace Library\ShowDiv;

abstract class ShowDiv{

	

	public function __construct(){

	}


	//return $this->getAjaxPost(  $service, $methode, $data, $functionName);
	
	public function getHtmlButtonShowDiv($idButtonShowDiv, $value){
		return "<input type='button' value='$value' id='$idButtonShowDiv' >";
		
	}

	public function getScriptShowDiv($divContainerName,$idDiv, $scriptAjax, $functionName){		//$service, $methode, $data, $functionName){

		return "
		<script type='text/javascript'>
				$(document).ready(function(){
					$('#$divContainerName').css('display', 'none');

					$('#$idDiv')
						.click(function(){
							if( $('#$divContainerName').css('display') == 'block' ){
								$('#$divContainerName').css('display', 'none');
							}else{
								$('#$divContainerName').css('display', 'block');	
							}
						});

					$('#btnCancel')
						.click(function(){
							$('#$divContainerName').css('display', 'none');
						})

					/*$('#$divContainerName').click(function(){
						$('#$divContainerName').css('display', 'none');
					});*/

					$('#{$divContainerName}BtnShowDiv').click(function(){
						{$functionName}();
					});



				});
				
				$scriptAjax
				
		</script>
		";
	}



	public function getHtmlShowDiv($divContainerName, $titre, $value, $type){
		return
		"
		<div id='$divContainerName' style=''>
			<select id='showDivSelect'></select>
			<span>Ajout $titre</span>
		
			<div id='inputShowDiv'>
				<label name='labelValue' id='labelValue'>$value : </label>
				<input type='text' name='value' id='{$divContainerName}Value' class='inputTextShowDiv'>

				<input  class='btn btn-cancel' id='btnCancel' value='Annuler' >
				<input id='{$divContainerName}BtnShowDiv' class='btn btn-primary' value='Valider l ajout de $type'>

			<!--button name='btnShowDiv' class='btn btn-lg btn-primary'>Valider l'ajout de $type</button-->
			</div>
		</div>";
	}





}