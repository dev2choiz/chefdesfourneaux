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



	public function getHtmlPopup($id, $prix, $ref, $value){
		return
		"
		<div id='popupContainer'>

			<div id=popup>
				<h4>Modification d'un produit</h4>

				<input type='hidden' value='$id' id='id_produit' name='id_produit'>
				<div class='col-md-6'>Prix :</div>
				<div class='col-md-6'>
					<input name='prix' type='text' id='prix' value='$prix €'>
				</div>
				<div class='col-md-6'>Ref :</div>
				<div class='col-md-6'>
					<input name='ref' type='text' id='ref' value='$ref'>
				</div>
				<div class='col-md-6'>Nom du produit : </div>
				<div class='col-md-6'>
					<input name='value' type='text' id='value' value='$value'>
				</div>

				<button class='col-md-4 btn btn-default' id='btnCancel' name='btnSupprimerProduit'>Annuler</button>
				<button class='col-md-4 btn btn-danger' id='btnSupprimerProduit' name='btnSupprimerProduit'>Supprimer</button>
				<button class='col-md-4 btn btn-success' id='btnMettreAjourProduit' name='btnMiseAjourProduit'>Mettre à jour</button>
	
			</div>
		</div>";
	}
}