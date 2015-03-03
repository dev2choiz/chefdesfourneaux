<?php

namespace Library\ShowDiv;

abstract class ShowDiv{

	

	public function __construct(){

	}


	//return $this->getAjaxPost(  $service, $methode, $data, $functionName);
	


	public function getScriptShowDiv($idDiv, $scriptAjax){		//$service, $methode, $data, $functionName){

		return "
		<script type='text/javascript'>
				$(document).ready(function(){
					//$('#showDivContainer').css('display', 'none');
					//$('#inputShowDiv').css('display', 'none');

					$('#$idDiv')
						.click(function(){
							if( $('#showDivContainer').css('display') == 'block' ){
								$('#showDivContainer').css('display', 'none');
							}else{
								$('#showDivContainer').css('display', 'block');	
							}
							
						});
					$('#btnCancel')
						.click(function(){
							$('#showDivContainer').css('display', 'none');
						})

					/*$('#showDivContainer').click(function(){
						$('#showDivContainer').css('display', 'none');
						$('#inputShowDiv').css('display', 'none');
					});*/
				});
				
				$scriptAjax
				
		</script>
		";
	}



	public function getHtmlShowDiv($titre, $value, $type){
		return
		"
		<div id='showDivContainer' style=''>dlhdkghmk
			<select id='showDivSelect'></select>
			<span>Ajout $titre</span>
		
			<div id='inputShowDiv'>
				<label name='labelValue' id='labelValue'>$value : </label>
				<input type='text' name='value' id='value'>

			

			<button name='btnCancel' class='btn btn-cancel' id='btnCancel'>Annuler</button>

			<button name='btnShowDiv' class='btn btn-primary'>Valider l'ajout de $type</button>
			</div>
		</div>";
	}





}