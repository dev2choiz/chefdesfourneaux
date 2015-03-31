$(document).ready(function(){

		$('#btnAjouterProduitShowDiv').click(function(){
			if( $('.ajouterProduitShowDiv').css('display') == 'block' ){
				$('.ajouterProduitShowDiv').css('display', 'none');
			}else{
				$('.ajouterProduitShowDiv').css('display', 'block');	
			}
		});

		$('#apercuImageProduit').css('display', 'none');

		//cache toi ici
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


            console.log(script);



			$("#WrapperProduits").append(script);
			//$("#WrapperProduits").html("##########"+script);
			//document.getElementById("WrapperProduits").innerHTML="##########"+script;
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
		'prix' 			: parseInt( $('#popupContainer'+idProd+' #prix').val() ),
		'ref' 			: $('#popupContainer'+idProd+' #ref').val()
	};

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
		'service' 		: 'Produit',
		'method' 		: 'deleteProduit',
		'id_produit' 	: $('#popupContainer'+idProd+' #id_produit').val()
	};
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
		'service' 		: 'Produit',
		'method' 		: 'recupererScriptNewProduit',
		'id_produit' 	: idProd
	};
	
		alert("dans recuperer script");
   	$.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {

        	console.log(data.response);
        	alert('console looog');
        	alors = data.response;

        }
    });
    alert(alors);
    return alors;

}




