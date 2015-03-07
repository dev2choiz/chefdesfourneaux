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

            //console.log("############################################",data); //
            ids=parseInt((data['response']));
            script = recupererScriptNewProduit(ids) ;


            console.log(script);
            //laisse moi t'aider un peu

			$("#WrapperProduits").html($("#WrapperProduits").html()+"####"+script);
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
        async:false,
        success: function(data) {
        	console.log(data['response']);
        	alors= data['response'];
        		//alert("dans recup"+alors);
        	// avec ca, on devrait reperer le probleme
        	// Je pense qu'on peut aussi essayer de garder le return devant ajax et aller ch
        	// chercher la reponse
        	// oui
        	// La doc avec l'air de dire que le return après $.ajax ne marchait pas 
        	// MAis oui regardons ça quand même
        	// la doc dit que on ne pt pas faire ca??
        	// attends, je te montre
        	//  : Ils dissent qu'on ne peut pas return d'une 
        	// méthode qui est async
        	// je me disait la meme chose
        	// c'est quoi la dif? sync et async
        	// Je pense que ça permet de ne pas faire les deux truc en même 
        	// temps mais que ça bloque le avigateur tant qu'il n'a pas réussi
        	// on essaie?yes

        }
    });
    return alors;

}
