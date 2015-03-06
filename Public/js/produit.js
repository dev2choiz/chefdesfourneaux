/*
* Fichier javascript permettant de gérer la page vente/indexproduit
*/

$(document).ready(function(){

	// La popup apparaît quand on clique sur le bouton Modifier le produit
	$('.popupProduit')
		.click(function(){
			$('#popupContainer').css('display', 'block');
			$('#popup').css('display', 'block');	

		});

	// Le bouton annuler permet de faire disparaître la popup
	$('#btnCancel')
		.click(function(){
			$('#popupContainer').css('display', 'none');
			$('#popup').css('display', 'none');
		})



	$('#btnAjouterProduit').click(function(){
		ajouterProduit();
	}); 

	$('#btnMettreAjourProduit').click(function(){
		mettreAjourProduit();
	});

	$('#btnSupprimerProduit').click(function(){
		supprimerProduit();
	});
});

function ajouterProduit(){

	jsonData = 
	{
		'service' 	: 'produit',
		'method' 	: 'insertproduit',
		'value' 	: $('#value').val(),
		'prix' 		: $('#prix').val(),
		'ref' 		: $('#ref').val()
	}

	console.log($('#ref').val());

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);

        }
    });
}

function mettreAjourProduit(){

	jsonData = 
	{
		'service' 		: 'produit',
		'method' 		: 'updateproduit',
		'id_produit' 	: $('#id_produit').val(),
		'value' 		: $('#value').val(),
		'prix' 			: $('#prix').val(),
		'ref' 			: $('#ref').val()
	}

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);

        }
    });
}

function supprimerProduit(){

	jsonData = 
	{
		'service' 		: 'produit',
		'method' 		: 'deleteproduit',
		'id_produit' 	: $('#id_produit').val()
	}
	console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {

        }
    });
}
