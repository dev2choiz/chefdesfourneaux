

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



			}else if($('#textCatAjouter').is(':visible')){
				alert( "ici on modifie une categorie"  );

			}else if($('#textCatAjouter').is(':visible')){
				alert( "ici on supprime une categorie"  );
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
			$('#textCatSupprimer').css('display', 'none');
			
			//ici "effacer" le contenu des autres trucs et les rendre invisibles
			$('#textCatModifier').css('display', 'none');
			$('#textCatSupprimer').css('display', 'none');
			
		}
	);

	$('#btnCatModifier')
		.click(function(){
			$('#divUnit').css('display', 'block');
		}
	);

	$('#btnCatSupprimer')
		.click(function(){
			$('#divUnit').css('display', 'block');
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






