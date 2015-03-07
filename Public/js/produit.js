/*
* Fichier javascript permettant de gérer la page vente/indexproduit
*/
/*
$(document).ready(function(){

	// La popup apparaît quand on clique sur le bouton Modifier le produit
	$('.popupProduit')
		.click(function(){
			$('#popupContainer').css('display', 'block');
			//$('#popup').css('display', 'block');	

		});

	// Le bouton annuler permet de faire disparaître la popup
	$('#btnCancel')
		.click(function(){
			$('#popupContainer').css('display', 'none');
			//$('#popup').css('display', 'none');
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
*/



$(document).ready(function(){

	$('#btnAjouterProduit').click(function(){
		ajouterProduit();
	});

});

function ajouterProduit(){
	jsonData = 
	{
		'service' 	: 'produit',
		'method' 	: 'insertproduit',
		'value' 	: $('#WrapperAddProduit #value').val(),
		'prix' 		: parseInt( $('#WrapperAddProduit #prix').val() ),
		'ref' 		: $('#WrapperAddProduit #ref').val()
	}

	script="";

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :true,
        success: function(data) {

            //console.log(data);
            script = recupererScriptNewProduit(parseInt((data['response'])) );
            
            //console.log(script);

			$("#WrapperProduits").html("##########"+$("#WrapperProduits").html()+script);
			//$("#WrapperProduits").html("##########"+script);
			//document.getElementById("WrapperProduits").innerHTML="##########"+script;
        }
    });
}





function mettreAjourProduit(idProd){


	jsonData = 
	{
		'service' 		: 'produit',
		'method' 		: 'updateproduit',
		'id_produit' 	: $('#popupContainer'+idProd+' #id_produit').val(),
		'value' 		: $('#popupContainer'+idProd+' #value').val(),
		'prix' 			: parseInt( $('#popupContainer'+idProd+' #prix').val() ),
		'ref' 			: $('#popupContainer'+idProd+' #ref').val()
	}

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
			$('#popupContainer'+idProd).css('display', 'none');
			
			$('#WrapperProduit'+idProd+" #labelValueProduit" ).html( $('#popupContainer'+idProd+' #value').val() );
			$('#WrapperProduit'+idProd+" #labelPrixProduit" ).html( parseInt( $('#popupContainer'+idProd+' #prix').val() ) );
			$('#WrapperProduit'+idProd+" #labelRefProduit" ).html( $('#popupContainer'+idProd+' #ref').val() );


        }
    });
}

function supprimerProduit(idProd){

	jsonData = 
	{
		'service' 		: 'produit',
		'method' 		: 'deleteproduit',
		'id_produit' 	: $('#popupContainer'+idProd+' #id_produit').val()
	}
	console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {

        	$('#WrapperProduit'+idProd).remove();	//supprime le produit dans la liste
        	$('#popupContainer'+idProd).remove();	//supprime le popup du produit

        }
    });
}


alors="";
function recupererScriptNewProduit(idProd){

	jsonData = 
	{
		'service' 		: 'produit',
		'method' 		: 'recupererScriptNewProduit',
		'id_produit' 	: idProd
	}
	
	
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:true,
        success: function(data) {
        	alors= data['response'];

        }
    });
    return alors;
}
