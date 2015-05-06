
 
$(document).ready(function(){
	$('#divChoixCat').css('display', 'none');
	$('#divChoixIng').css('display', 'none');
	$('#divChoixUnit').css('display', 'none');

	$('#apercuImageCat').css('display', 'none');


	//$('#frameImgCat').css('display', 'none');
	

	//CATEGORIE
	$('#categories')
		.click(function(){
			//affiche la div contenant le choix des actions possibles 
			$('#divChoixCat').css('display', 'block');

			//masque les autres
			$('#divChoixIng').css('display', 'none');
			$('#divChoixUnit').css('display', 'none');

			//masque les inputs et le bouton pour valider
			$('#divCat').css('display', 'none');

			//masque divIng et divUnit
			$('#divIng').css('display', 'none');
			$('#divUnit').css('display', 'none');


		}
	);

	$('#categories').change(function(){

			$('#apercuImageCat').css('display', 'block');

			var cat=document.getElementById('categories');

			//donne l'id de la categorie selectionné au formulaire
			document.getElementById('inputIdCat').value=cat.options[cat.selectedIndex].value;

			str=recupererImageCat(cat.options[cat.selectedIndex].value);
			//alert("onchange"+str);
			if (str==="") {
				$('#wrapperImgCat #imgCat').attr('src', "");
			}else{
				//alert("onchange"+str);
				$('#wrapperImgCat #imgCat').attr('src', str);
			}
		}
	);



	//afficher l'image selectionnée 		marche pas
	$('#inputFileImgCatModifier').change(function(){

		
	    input=document.getElementById('inputFileImgCatModifier');
		 if (input.files && input.files[0]) {
		    var reader = new FileReader();
		    reader.onload = function (e) {
		        //alert(e.target.result);
		        $('#imgCat').attr('src',e.target.result);
		        return true;
			};
	    	reader.readAsDataURL(input.files[0]);
	    }

			
	});











	$('#btnCatValider')
		.click(function(){
			if ( $('#textCatAjouter').is(':visible') ) {
				ajouterCategorie();

			}else if($('#textCatModifier').is(':visible')){
				modifierCategorie();

			}
		}
	);


	//bouttons qui quand on clique decu, affiche l'input text correspondant
	$('#btnCatAjouter')
		.click(function(){
			$('#divCat').css('display', 'block');
			$('#textCatAjouter').css('display', 'block');
			$('#textCatModifier').css('display', 'none');

			$('#inputFileImgCatModifier').css('display', 'block');
			




		}
	);

	$('#btnCatModifier')
		.click(function(){
			$('#divCat').css('display', 'block');
			$('#textCatAjouter').css('display', 'none');
			$('#textCatModifier').css('display', 'block');

			$('#inputFileImgCatModifier').css('display', 'block');

			$('#textCatModifier').val(document.getElementById('categories').options[document.getElementById('categories').selectedIndex].text);

		}
	);

	$('#btnCatSupprimer')
		.click(function(){
			$('#textCatAjouter').css('display', 'none');
			$('#textCatModifier').css('display', 'none');

			$('#inputFileImgCatModifier').css('display', 'none');

			supprimerCategorie();
		}
	);







	//INGREDIENT

	$('#ingredients')
		.click(function(){
			//affiche la div contenant le choix des actions possibles 
			$('#divChoixIng').css('display', 'block');

			//masque les autres
			$('#divChoixCat').css('display', 'none');
			$('#divChoixUnit').css('display', 'none');

			$('#apercuImageCat').css('display', 'none');

			//masque les inputs et le bouton pour valider
			$('#divIng').css('display', 'none');

			//masque divCat et divUnit
			$('#divCat').css('display', 'none');
			$('#divUnit').css('display', 'none');
		}
	);



	$('#btnIngValider')
		.click(function(){
			if ( $('#textIngAjouter').is(':visible') ) {
				ajouterIngredient();

			}else if($('#textIngModifier').is(':visible')){
				modifierIngredient();
				

			}
		}
	);


	//bouttons qui quand on clique decu, affiche l'input text correspondant
	$('#btnIngAjouter')
		.click(function(){
			$('#divIng').css('display', 'block');
			$('#textIngAjouter').css('display', 'block');
			$('#textIngModifier').css('display', 'none');
		}
	);

	$('#btnIngModifier')
		.click(function(){
			$('#divIng').css('display', 'block');
			$('#textIngAjouter').css('display', 'none');
			$('#textIngModifier').css('display', 'block');
			$('#textIngModifier').val(document.getElementById('ingredients').options[document.getElementById('ingredients').selectedIndex].text);
		}
	);

	$('#btnIngSupprimer')
		.click(function(){
			$('#textIngAjouter').css('display', 'none');
			$('#textIngModifier').css('display', 'none');
			supprimerIngredient();
		}
	);










	//UNITE




	$('#unites')
		.click(function(){
			//affiche la div contenant le choix des actions possibles
			$('#divChoixUnit').css('display', 'block');

			//masque les autres
			$('#divChoixIng').css('display', 'none');
			$('#divChoixCat').css('display', 'none');

			$('#apercuImageCat').css('display', 'none');

			//masque les inputs et le bouton pour valider
			$('#divUnit').css('display', 'none');

			//masque divIng et divCat
			$('#divIng').css('display', 'none');
			$('#divCat').css('display', 'none');
		}
	);



	$('#btnUnitValider')
		.click(function(){
			if ( $('#textUnitAjouter').is(':visible') ) {
				ajouterUnite();
			}else if($('#textUnitModifier').is(':visible')){
				modifierUnite();
			}
		}
	);


	//bouttons qui quand on clique decu, affiche l'input text correspondant
	$('#btnUnitAjouter')
		.click(function(){
			$('#divUnit').css('display', 'block');
			$('#textUnitAjouter').css('display', 'block');
			$('#textUnitModifier').css('display', 'none');
		}
	);

	$('#btnUnitModifier')
		.click(function(){
			$('#divUnit').css('display', 'block');
			$('#textUnitAjouter').css('display', 'none');
			$('#textUnitModifier').css('display', 'block');
			$('#textUnitModifier').val(document.getElementById('unites').options[document.getElementById('unites').selectedIndex].text);
		}
	);

	$('#btnUnitSupprimer')
		.click(function(){
			$('#textUnitAjouter').css('display', 'none');
			$('#textUnitModifier').css('display', 'none');
			supprimerUnite();
		}
	);


});







//LES FONCTIONS CATEGORIE



function ajouterCategorie(){

	jsonData={};
	jsonData['service']= 'Categorie';
	jsonData['method']= 'insertCategorie';
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
	jsonData['service']= 'Categorie';
	jsonData['method']= 'updateCategorie';
	jsonData['id_cat']= cat.options[cat.selectedIndex].value;
    jsonData['value']	= $("#textCatModifier").val();

	//jsonData['img']=$("#inputFileImgCatModifier").val();
	//alert(jsonData['img']);

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
	jsonData['service']= 'Categorie';
	jsonData['method']= 'deleteCategorie';
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


//##############################je separe###########################################

//LES FONCTIONS INGREDIENT

function ajouterIngredient(){

	jsonData={};
	jsonData['service']= 'Ingredient';
	jsonData['method']= 'insertIngredients';
    jsonData['value']=$("#textIngAjouter").val();

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
            	
            	$("#ingredients").append("<option value='"+data['response']+"'>"+$("#textIngAjouter").val()+"</option>");
            	alert("Ingredient ajouté");
            }

        }
    }); 
}


function modifierIngredient(){
	ing=document.getElementById("ingredients");
	jsonData={};
	jsonData['service']= 'Ingredient';
	jsonData['method']= 'updateIngredient';
	jsonData['id_ingredient']= ing.options[ing.selectedIndex].value;
    jsonData['value']	= $("#textIngModifier").val();

    console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data['response']===false){
            	alert("erreur pendant la modification de l'ingrédient");
            }else{
            	
            	ing.options[ing.selectedIndex].text=$("#textIngModifier").val();
            	alert("ingredient modifié");
            }
        }
    }); 
}


function supprimerIngredient(){

	ing=document.getElementById("ingredients");
	jsonData={};
	jsonData['service']= 'Ingredient';
	jsonData['method']= 'deleteIngredient';
	jsonData['id_ingredient']= ing.options[ing.selectedIndex].value;
  	alert(ing.options[ing.selectedIndex].value);

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
            	
            	$("#ingredients option:selected").remove();
            	alert("supprimé");
            }
        }
    }); 
}

















//##############################je separe###########################################

//LES FONCTIONS UNITE

function ajouterUnite(){

	jsonData={};
	jsonData['service']= 'Unite';
	jsonData['method']= 'insertUnites';
    jsonData['value']=$("#textUnitAjouter").val();

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
            	
            	$("#unites").append("<option value='"+data['response']+"'>"+$("#textUnitAjouter").val()+"</option>");
            	alert("Unité ajouté");
            }

        }
    }); 
}


function modifierUnite(){
	unit=document.getElementById("unites");
	jsonData={};
	jsonData['service']= 'Unite';
	jsonData['method']= 'updateUnite';
	jsonData['id_unite']= unit.options[unit.selectedIndex].value;
    jsonData['value']	= $("#textUnitModifier").val();

    console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data['response']===false){
            	alert("erreur pendant la modification de l'unité");
            }else{
            	
            	unit.options[unit.selectedIndex].text=$("#textUnitModifier").val();
            	alert("unite modifié");
            }
        }
    }); 
}


function supprimerUnite(){

	unit=document.getElementById("unites");
	jsonData={};
	jsonData['service']= 'Unite';
	jsonData['method']= 'deleteUnite';
	jsonData['id_unite']= unit.options[unit.selectedIndex].value;
  	alert(unit.options[unit.selectedIndex].value);

    console.log(jsonData);

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            if(data['response']===false){
            	alert("il se peut que cette unite soit utilisé dans une recette.\n Il ne peut donc pas etre supprimé.");
            }else{
            	
            	$("#unites option:selected").remove();
            	alert("unité supprimé");
            }
        }
    }); 
}





function recupererImageCat(idCat){
	unit=document.getElementById("unites");
	jsonData={};
	jsonData['service']= 'Categorie';
	jsonData['method']= 'getImageCategorie';
	jsonData['id_cat']= idCat;


    console.log(jsonData);

    var res="";
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {
            console.log("ici",data['response']);
            if(data['response']===false){
            	res= "";
            }else{
            	res= data['response'];
            }
        }
    });
    console.log("res",res);
    return res;
}

function finUpload(error, path) {
    if (error === 'non') {
    	var cat=document.getElementById('categories');
        $('#wrapperImgCat #imgCat').attr( 'src', recupererImageCat(cat.options[cat.selectedIndex].value) );
        alert("image envoyée" );
    } else {
        alert(error);
    }
}

$( "#formImgCat" ).submit(function( event ) {
	if ($('#inputFileImgCatModifier').val()==='') {
		alert('veuillez selectionner une image');
		event.preventDefault();
    }
});

