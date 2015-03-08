<?php

namespace Application\Models;

class PopUpProduit extends \Library\PopUp\PopUp{

	public function __construct(){

	}



	public function getModifPopup($id, $prix, $ref, $value){
		return
		"
		<div class='popupContainer' id='popupContainer$id'>

			<div class='popup' id='popup$id'>
				<h3>Modification d'un produit</h3>

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

				<button class='col-md-4 btn btn-default' id='btnCancel$id' name='btnSupprimerProduit'>Annuler</button>
				<button class='col-md-4 btn btn-danger' id='btnSupprimerProduit$id' name='btnSupprimerProduit'>Supprimer</button>
				<button class='col-md-4 btn btn-success' id='btnMettreAjourProduit$id' name='btnMiseAjourProduit'>Mettre à jour</button>
	
			</div>
		</div>


		<script type='text/javascript'>
			
			$(document).ready(function(){

				// La popup apparaît quand on clique sur le bouton Modifier le produit
				$('#popupProduit$id')
					.click(function(){
						$('#popupContainer$id').css('display', 'block');
						$('#popup$id').css('display', 'block');	

					});

				// Le bouton annuler permet de faire disparaître la popup
				$('#btnCancel$id')
					.click(function(){
						$('#popupContainer$id').css('display', 'none');
						//$('#popup$id').css('display', 'none');
					})



				$('#btnAjouterProduit$id').click(function(){
					ajouterProduit($id);
				}); 

				$('#btnMettreAjourProduit$id').click(function(){
					mettreAjourProduit($id);
				});

				$('#btnSupprimerProduit$id').click(function(){
					if (confirm('Voulez-vous supprimer ce produit ?')) {
						supprimerProduit($id);
					}
				});
			});
		</script>

		";
	}




public function getAcheterPopup($idProd, $prix, $ref, $value){
		return
		"
		<script type='text/javascript'>
			
			$(document).ready(function(){

				//ajoute au panier apres un click
				$('#WrapperProduit$idProd #btnAcheterProduit')
					.click(function(){
						ajouterAuPanier({$_SESSION['user']['id_user']}, $idProd);
						
					});

			});
		</script>

		";
	}

}