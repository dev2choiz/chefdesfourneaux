// Définitions de constantes utilisables dans tout le fichier

API_URL = "http://localhost/webservice/Public/index.php"

$(document).ready(function(){

	$('.btnAcheterProduit').click(function(){
		ajouterAuPanier(idUser, idProd);
	});

});


// On pourra acheter dans indexproduit et produit

function ajouterAuPanier(idUser, idProd){

	i = parseInt($('#panierContent').html());

	$('#panierContent').html(i+1);

	jsonData = 
	{
		'service' 		: 'panier',
		'method' 		: 'insert',
		'id_produit' 	: $('#id_produit').val(),
		'id_user' 		: id_user

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
