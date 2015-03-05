

$(document).ready(function(){
	$('#divChoixCat').css('display', 'none');
	$('#divChoixIng').css('display', 'none');
	$('#divChoixUnit').css('display', 'none');


//$('#btnCat').css('display', 'block'); par defaut


	$('#categories')
		.click(function(){
			//affiche la div contenant le choix des actions possibles 
			$('#divChoixCat').css('display', 'block');

			//masque les inputs et le bouton pour valider
			$('#divCat').css('display', 'none');
		}
	);


	$('#btnCatValider')
		.click(function(){
			if ( $('#textCatAjouter').is(':visible') ) {
				ajouterCategorie();
				alert( "ici on ajoute une categorie"  );

			}else if($('#textCatModifier').is(':visible')){
				modifierCategorie();
				alert( "ici on modifie une categorie"  );

			}
		}
	);











	$('#ingredients')
		.click(function(){
			$('#divIng').css('display', 'block');
		}
	);

	$('#unites')
		.click(function(){
			$('#divUnit').css('display', 'block');
		}
	);



	/*
	$('#btnCatAjouter').css('display', 'none');
	$('#btnCatModifier').css('display', 'none');
	$('#btnCatSupprimer').css('display', 'none');*/



		//bouttons qui quand on clique decu, affiche l'input text et le bouton valider
	$('#btnCatAjouter')
		.click(function(){
			$('#divCat').css('display', 'block');
			
			$('#textCatAjouter').css('display', 'block');
			$('#textCatModifier').css('display', 'none');

			
		}
	);

	$('#btnCatModifier')
		.click(function(){

			$('#divCat').css('display', 'block');
			
			$('#textCatAjouter').css('display', 'none');
			$('#textCatModifier').css('display', 'block');

			
		}
	);

	$('#btnCatSupprimer')
		.click(function(){
			$('#textCatAjouter').css('display', 'none');
			$('#textCatModifier').css('display', 'none');

			supprimerCategorie();

			//$('#divCat').css('display', 'block');


			

		}


	);





	/*$('#{$divContainerName}BtnShowDiv').submit(function(e){t
	    e.preventDefault();
	 
	 }); */   





});



function ajouterCategorie(){

	jsonData={};
	jsonData['service']= 'categorie';
	jsonData['method']= 'insertcategorie';
    jsonData['value']=$("#textCatAjouter").val();

    console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data['response']===false){
            	alert("erreur pendant l'ajout");
            }else{
            	
            	$("#categories").append("<option value='"+data['response']+"'>"+$("#textCatAjouter").val()+"</option>");
            	alert("ajouté");
            }

        }
    }); 
}



function modifierCategorie(){
	cat=document.getElementById("categories");
	jsonData={};
	jsonData['service']= 'categorie';
	jsonData['method']= 'updatecategorie';
	jsonData['id_cat']= cat.options[cat.selectedIndex].value;
    jsonData['value']	= $("#textCatModifier").val();

    console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data['response']===false){
            	alert("erreur pendant l'ajout");
            }else{
            	
            	cat.options[cat.selectedIndex].text=$("#textCatModifier").val();
            	alert("modifié");
            }

        }
    }); 
}





function supprimerCategorie(){

	cat=document.getElementById("categories");
	jsonData={};
	jsonData['service']= 'categorie';
	jsonData['method']= 'deletecategorie';
	jsonData['id_cat']= cat.options[cat.selectedIndex].value;
  	alert(cat.options[cat.selectedIndex].value);

    console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data['response']===false){
            	alert("il se peut que cette ingredient soit utilisé dans une recette.\n Il ne peut donc pas etre supprimé.");
            }else{
            	
            	$("#categories option:selected").remove();
            	alert("supprimé");
            }

        }
    }); 
}




