// Définitions de constantes utilisables dans tout le fichier

API_URL = "http://localhost/webservice/Public/index.php"



$(document).ready(function(){
		actualiserPanier(id_user);
	}
);











// On pourra acheter dans indexproduit et produit

function ajouterAuPanier(idUser, idProd){
	jsonData = 
	{
		'service' 		: 'panier',
		'method' 		: 'insertPanier',
		'id_user' 		: idUser,
		'id_produit' 	: idProd
	}
	
	
   	$.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {
			console.log(data);
			/*if (data['response']>0) {
				$('#WrapperProduit'+idProd+" #btnAcheterProduit" ).css("visibility", "hidden");
			}else{
				$('#WrapperProduit'+idProd+" #btnAcheterProduit" ).css("visibility", "visible");
			}*/
			actualiserPanier(idUser);
			
		}
    });
    



}




function actualiserPanier(idUser){
	jsonData = 
	{
		'service' 		: 'panier',
		'method' 		: 'getHtmlIconPanier',
		'id_user' 		: idUser
	}
	
	
   	$.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data){
			
			//alert(data['response']);
			$('#panierContent').html( data['response'] );
				
			
			
		}
    });
    



}





