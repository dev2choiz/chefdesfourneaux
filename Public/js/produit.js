$(document).ready(function(){

		$('#btnAjouterProduitShowDiv').click(function(){
			if( $('.ajouterProduitShowDiv').css('display') == 'block' ){
				$('.ajouterProduitShowDiv').css('display', 'none');
			}else{
				$('.ajouterProduitShowDiv').css('display', 'block');	
			}
		});

		$('#apercuImageProduit').css('display', 'none');

		$('#frameImgProduit').css('display', 'none');

		$('#btnAjouterProduit').click(function(){
			ajouterProduit();
		});

	}
);


function ajouterProduit(){
	jsonData = 
	{
		'service' 	: 'Produit',
		'method' 	: 'insertProduit',
		'value' 	: $('#WrapperAddProduit #value').val(),
		'prix' 		: parseInt( $('#WrapperAddProduit #prix').val() ),
		'ref' 		: $('#WrapperAddProduit #ref').val()
	};

	script="";

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :true,
        success: function(data) {

            ids = parseInt((data.response));
            script = recupererScriptNewProduit(ids) ;

			$("#WrapperProduits").append(script);
			alert("produit ajouté");
			
        }

    });
}





function mettreAjourProduit(idProd){


	jsonData = 
	{
		'service' 		: 'Produit',
		'method' 		: 'updateProduit',
		'id_produit' 	: $('#popupContainer'+idProd+' #id_produit').val(),
		'value' 		: $('#popupContainer'+idProd+' #value').val(),
		'prix' 			: parseFloat( $('#popupContainer'+idProd+' #prix').val() ),
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
			$('#WrapperProduit'+idProd+" #labelPrixProduit" ).html( parseFloat( $('#popupContainer'+idProd+' #prix').val() ) );
			$('#WrapperProduit'+idProd+" #labelRefProduit" ).html( $('#popupContainer'+idProd+' #ref').val() );


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
function recupererScriptNewProduit(idProd){

	jsonData = 
	{
		'service' 		: 'Produit',
		'method' 		: 'recupererScriptNewProduit',
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
    //alert(alors);
    return alors;

}




