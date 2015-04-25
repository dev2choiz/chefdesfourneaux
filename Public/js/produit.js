$(document).ready(function(){

		$('#btnAjouterProduitShowDiv').click(function(){
			if( $('.ajouterProduitShowDiv').css('display') == 'block' ){
				$('.ajouterProduitShowDiv').hide('slow');
				//$('.ajouterProduitShowDiv').css('display', 'none');
			}else{
				$('.ajouterProduitShowDiv').show('slow');
				//$('.ajouterProduitShowDiv').css('display', 'block');	
			}
		});

		$('#apercuImageProduit').css('display', 'none');

		$('#frameImgProduit').css('display', 'none');

		$('#uploadSubmitProd').click(function(){
			ajouterProduit();
		});
		$('#frameImgProduit').css('display', 'block');

	}
);


function ajouterProduit(){
	alert("dans ajouter");

    

	$('#WrapperAddProduit #prix').val( formatFloat( $('#WrapperAddProduit #prix').val() ) );
	if ($('#WrapperAddProduit #prix').val()+0>2000000) {
		event.preventDefault();
		alert('le prix est trop élevé');
	}
	

/*	jsonData = 
	{
		'service' 	: 'Produit',
		'method' 	: 'insertProduit',
		'value' 	: $('#WrapperAddProduit #value').val()+"par ajax",
		'prix' 		: formatFloat( $('#WrapperAddProduit #prix').val() ),
		'ref' 		: $('#WrapperAddProduit #ref').val()
	};


	script="";

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
			alert("dans success de ajouter");
        	console.log("data = ",data);
            ids = parseInt(data.response);
            console.log("ids = ",ids);


            //recupere les données du produit aupres du webservice
			dataProd = getProduit(ids);
			

			//mettre en place le popup puis l'ajax
			var popupProd="\
			<div class='popupContainer' id='popupContainer"+dataProd.id_produit+"'>\
				<div class='popup' id='popup"+dataProd.id_produit+"'>\
					<h3>Modification d'un produit</h3>\
					<input type='hidden' value='"+dataProd.id_produit+"' id='id_produit' name='id_produit'>\
					<div class='col-md-6'>Prix :</div>\
					<div class='col-md-6'>\
						<input name='prix' type='text' id='prix' value='"+formatMoney(dataProd.prix)+" €'>\
					</div>\
					<div class='col-md-6'>Ref :</div>\
					<div class='col-md-6'>\
						<input name='ref' type='text' id='ref' value='"+dataProd.ref+"'>\
					</div>\
					<div class='col-md-6'>Nom du produit : </div>\
					<div class='col-md-6'>\
						<input name='value' type='text' id='value' value='"+dataProd.value+"'>\
					</div>\
					<button class='col-md-4 btn btn-default' id='btnCancel1' name='btnSupprimerProduit'>Annuler</button>\
					<button class='col-md-4 btn btn-danger' id='btnSupprimerProduit1' name='btnSupprimerProduit'>Supprimer</button>\
					<button class='col-md-4 btn btn-success' id='btnMettreAjourProduit1' name='btnMiseAjourProduit'>Mettre à jour</button>\
				</div>\
			</div>";
			
            var strHtml="\
			<div class='row' id='WrapperProduit"+dataProd.id_produit+"'>\
				<div class='col-md-4'>\
					<a href='"+LINK_ROOT+"vente/produit/"+dataProd.id_produit+"'>\
	        			<img class='media-object indexImg' src='"+urlImg+dataProd.img+"' alt='Poele'>\
	      			</a>\
					<a href='"+LINK_ROOT+"vente/produit/"+dataProd.id_produit+"'><span id='labelValueProduit'>"+dataProd.value+"</span></a>\
					<p>Référence : <span id='labelRefProduit'>"+dataProd.ref+"</span></p>\
				</div>\
				<div class='col-md-4'>\
					<span id='labelPrixProduit'>"+dataProd.prix+"</span> €\
				</div>\
				<div class='col-md-4'><!-- ??? -->\
				<button class='btn btn-success btnAcheterProduit' id='btnAcheterProduit'>Mettre ce produit dans mon panier</button>\
				\
				";

			// Si l'utilisateur est admin, on affiche le bouton modifier
			if (typeUser==="admin") {
				strHtml+="<button class='btn btn-primary btnPopupProduit' id='popupProduit1' >Modifier ce Produit</button>";
			}
			strHtml+="<div class='row'><!-- div bizarre -->\
			\
			"+popupProd+"\
					</div>\
				</div>\
			</div>\
			";
			
			$("#WrapperProduits").append(strHtml);


			//ajoute les evenements aux inputs qui viennent d'etre créés
			$(document).ready(function(){
				//ajoute au panier apres un click
				$('#WrapperProduit'+dataProd.id_produit+' #btnAcheterProduit').click(function(){
					ajouterAuPanier(idUser, dataProd.id_produit);
				});

				// La popup apparaît quand on clique sur le bouton Modifier le produit
				$('#popupProduit'+dataProd.id_produit).click(function(){
					$('#popupContainer'+dataProd.id_produit).css('display', 'block');
					$('#popup'+dataProd.id_produit).css('display', 'block');	
				});

				// Le bouton annuler permet de faire disparaître la popup
				$('#btnCancel'+dataProd.id_produit).click(function(){
					$('#popupContainer'+dataProd.id_produit).css('display', 'none');
				});

				// mise a jour du produit
				$('#btnMettreAjourProduit'+dataProd.id_produit).click(function(){
					mettreAjourProduit(dataProd.id_produit);
				});

				//supression du produit
				$('#btnSupprimerProduit'+dataProd.id_produit).click(function(){
					if (confirm('Voulez-vous supprimer ce produit ?')) {
						supprimerProduit(dataProd.id_produit);
					}
				});




			});


			
        }	//fin du success

    });		//fin du $.ajax
*/

}





function mettreAjourProduit(idProd){


	jsonData = 
	{
		'service' 		: 'Produit',
		'method' 		: 'updateProduit',
		'id_produit' 	: $('#popupContainer'+idProd+' #id_produit').val(),
		'value' 		: $('#popupContainer'+idProd+' #value').val(),
		'prix' 			: formatFloat( $('#popupContainer'+idProd+' #prix').val() ),
		'ref' 			: $('#popupContainer'+idProd+' #ref').val()
	};

    $.ajax({
        type: 'PUT',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
			$('#popupContainer'+idProd).css('display', 'none');
			
			$('#WrapperProduit'+idProd+" #labelValueProduit" ).html( $('#popupContainer'+idProd+' #value').val() );
			$('#WrapperProduit'+idProd+" #labelPrixProduit" ).html( formatMoney( $('#popupContainer'+idProd+' #prix').val(), false, 2 ) );
			$('#WrapperProduit'+idProd+" #labelRefProduit" ).html( $('#popupContainer'+idProd+' #ref').val() );

			$('#popupContainer'+idProd+' #prix').val( formatMoney( $('#popupContainer'+idProd+' #prix').val(), false, 2 )+" "+monnaie );

        }
    });
}

function supprimerProduit(idProd){

	jsonData = 
	{
		'service' 		: 'Produit',
		'method' 		: 'deleteProduit',
		'id_produit' 	: $('#popupContainer'+idProd+' #id_produit').val()
	};
	console.log(jsonData);

    $.ajax({
        type: 'DELETE',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
        	console.log(data);
        	$('#WrapperProduit'+idProd).remove();	//supprime le produit dans la liste
        	$('#popupContainer'+idProd).remove();	//supprime le popup du produit
        }
    });
}


alors="";
function getProduit(idProd){

	jsonData = 
	{
		'service' 		: 'Produit',
		'method' 		: 'getProduit',
		/*'method' 		: 'recupererScriptNewProduit',*/
		'id_produit' 	: idProd
	};

   	$.ajax({
        type: 'GET',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {

        	console.log(data.response);
        	
        	alors = data.response;

        }
    });
    return alors;

}




