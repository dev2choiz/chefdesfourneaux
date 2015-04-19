
function changerImage(idInput) {
    input=document.getElementById(idInput);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        alert("onload"+e.target.result);
        $('#imgProduit').attr('src',e.target.result);
        return true;
    };
    reader.readAsDataURL(input.files[0]);

  }
}



$(document).ready(function(){

    $("#inputFileImgProduitModifier").change(function(){
        //alert("on change hors cond");
        if (document.getElementById('inputFileImgProduitModifier').value!=='') {
            //alert("on change dans cond");
            changerImage('inputFileImgProduitModifier') ;
        }
    });

});




function finUpload(error,idProd) {

    if (error === 'non' && idProd>0) {
        //var prod=document.getElementById('');
        alert("donnees envoyées" );

        script = recupererScriptNewProduit(idProd) ;

        $("#WrapperProduits").append(script);

    } else {
        alert(error);
    }
}

$( "#formImgProduit" ).submit(function( event ) {
    //alert($('#inputFileImgProduitModifier').val()+' avan le test $Filehfh');
    if ($('#inputFileImgProduitModifier').val()==='') {
        alert('veuillez selectionner une image');
        event.preventDefault();
    }
});

