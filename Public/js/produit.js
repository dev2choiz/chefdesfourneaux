/*
* Fichier javascript permettant de gérer la page vente/indexproduit
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

            ids=parseInt((data['response']));
            script = recupererScriptNewProduit(ids) ;


            //console.log(script);
            //laisse moi t'aider un peu

			$("#WrapperProduits").append(script);
			
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
        async:false,
        success: function(data) {
        	console.log(data['response']);
        	alors= data['response'];

        }
    });
    return alors;

}
