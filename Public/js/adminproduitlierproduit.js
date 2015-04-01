

$(document).ready(function(){



		/*$('#btnAjouterProduit').click(function(){
			ajouterProduit();
		}); */
	}
);


function dissocierlierProduit(idRecette, idProduit){

	tst= produitDejaLie( idRecette, idProduit ) ;
	//alert("tst="+tst+"#"+nombreProduitAssocie( idRecette) );


	if(	tst ){
		deleteListProduit(idRecette, idProduit);
		$('#WrapperProduit'+idProduit+' #lierProduit').text("Lier ce produit à la recette");
	}else if(nombreProduitAssocie( idRecette) <3){
		insertListProduit(idRecette, idProduit);
		$('#WrapperProduit'+idProduit+' #lierProduit').text("Dissocier ce produit à la recette");
	}else{
		alert('vous ne pouvez pas lier plus de 3 produits à une recette');
	}


}

//alors=false;
function produitDejaLie(idRecette, idProduit){
	jsonData = 
	{
		'service' 		: 'ListProduit',
		'method' 		: 'getListProduit',
		'id_recette'	: idRecette,
		'id_produit'	: idProduit
	};


	alors=false;
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
        	console.log("data",data);

        	for (var i = 0; i < data.response.length; i++) {
        		//alert("idp"+data.response[i]['id_produit']+" --"+idProduit);
				if( data.response[i].id_produit===idProduit ){

					alors=true;

				}
        	}

        }
    });
    return alors;
}



function insertListProduit(idRecette, idProduit){

	jsonData = 
	{
		'service' 		: 'ListProduit',
		'method' 		: 'insertListProduit',
		'id_recette'	: idRecette,
		'id_produit'	: idProduit
	};



    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            alert("ajouté");
        }
    });

}


function deleteListProduit(idRecette, idProduit){

	jsonData = 
	{
		'service' 		: 'ListProduit',
		'method' 		: 'deleteListProduit',
		'id_recette'	: idRecette,
		'id_produit'	: idProduit
	};



    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            alert("supprimé");
        }
    });

}




function nombreProduitAssocie(idRecette){

	jsonData = 
	{
		'service' 		: 'ListProduit',
		'method' 		: 'nombreListProduit',
		'id_recette'	: idRecette
	};


	alors=false;
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            console.log(data.response);
            alors=data.response;
        }
    });
    return alors;
}

