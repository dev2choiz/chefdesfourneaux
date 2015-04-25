function changerImage(idInput) {
    input=document.getElementById(idInput);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        alert("onload"+e.target.result);
        $('#wrapperImgProduit').css('display', 'block');
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


$( "#formImgProduit" ).submit(function( event ) {
    //alert($('#inputFileImgProduitModifier').val()+' avan le test $Filehfh');
    if ($('#inputFileImgProduitModifier').val()==='') {
        alert('veuillez selectionner une image');
        event.preventDefault();
    }
});





function finUpload(error,idProd) {
    alert("finupload   "+error+"  ###"+ idProd);

    //remet le prix au format monetaire
    $('#WrapperAddProduit #prix').val( formatMoney( $('#WrapperAddProduit #prix').val() ) );

    if (error === 'non' && idProd>0) {
        alert("donnees envoyées" );
        creerVueNouveauProduit(idProd);
        $('.ajouterProduitShowDiv').hide('slow');
    } else {
        alert(error);
    }
}



function creerVueNouveauProduit(idProd){
    alert("dans success de creernewprod");


    
    //recupere les données du produit aupres du webservice
    dataProd = getProduit(idProd);
    console.log("dataprod"+idProd,dataProd);
    
    //mettre en place le popup puis l'ajax
    /*$script=$modelPopUpProduit->getPopup(   $produit['id_produit'],
                                $produit['prix'],
                                $produit['ref'],
                                $produit['value']);*/

    var popupProd="\
    <div class='popupContainer' id='popupContainer"+dataProd.id_produit+"'>\
        <div class='popup' id='popup"+dataProd.id_produit+"'>\
            <h3>Modification d'un produit</h3>\
            <input type='hidden' value='"+dataProd.id_produit+"' id='id_produit' name='id_produit'>\
            <div class='col-md-6'>Prix :</div>\
            <div class='col-md-6'>\
                <input name='prix' type='text' id='prix' value='"+formatMoney(dataProd.prix)+" €'>\
            </div>\
            <div class='col-md-6'>Ref :</div>\
            <div class='col-md-6'>\
                <input name='ref' type='text' id='ref' value='"+dataProd.ref+"'>\
            </div>\
            <div class='col-md-6'>Nom du produit : </div>\
            <div class='col-md-6'>\
                <input name='value' type='text' id='value' value='"+dataProd.value+"'>\
            </div>\
            <button class='col-md-4 btn btn-default' id='btnCancel1' name='btnSupprimerProduit'>Annuler</button>\
            <button class='col-md-4 btn btn-danger' id='btnSupprimerProduit1' name='btnSupprimerProduit'>Supprimer</button>\
            <button class='col-md-4 btn btn-success' id='btnMettreAjourProduit1' name='btnMiseAjourProduit'>Mettre à jour</button>\
        </div>\
    </div>";
    
    var strHtml="\
    <div class='row' id='WrapperProduit"+dataProd.id_produit+"'>\
        <div class='col-md-4'>\
            <a href='"+LINK_ROOT+"vente/produit/"+dataProd.id_produit+"'>\
                <img class='media-object indexImg' src='"+urlImg+dataProd.img+"' alt='Poele'>\
            </a>\
            <a href='"+LINK_ROOT+"vente/produit/"+dataProd.id_produit+"'><span id='labelValueProduit'>"+dataProd.value+"</span></a>\
            <p>Référence : <span id='labelRefProduit'>"+dataProd.ref+"</span></p>\
        </div>\
        <div class='col-md-4'>\
            <span id='labelPrixProduit'>"+dataProd.prix+"</span> €\
        </div>\
        <div class='col-md-4'><!-- ??? -->\
        <button class='btn btn-success btnAcheterProduit' id='btnAcheterProduit'>Mettre ce produit dans mon panier</button>\
        \
        ";

    // Si l'utilisateur est admin, on affiche le bouton modifier
    if (typeUser==="admin") {
        strHtml+="<button class='btn btn-primary btnPopupProduit' id='popupProduit1' >Modifier ce Produit</button>";
    }
    strHtml+="<div class='row'>\
    \
    "+popupProd+"\
            </div>\
        </div>\
    </div>\
    ";
    
    $("#WrapperProduits").append(strHtml);


    //ajoute les evenements aux inputs qui viennent d'etre créés
    $(document).ready(function(){
        //ajoute au panier apres un click
        $('#WrapperProduit'+dataProd.id_produit+' #btnAcheterProduit').click(function(){
            ajouterAuPanier(idUser, dataProd.id_produit);
        });

        // La popup apparaît quand on clique sur le bouton Modifier le produit
        $('#popupProduit'+dataProd.id_produit).click(function(){
            $('#popupContainer'+dataProd.id_produit).css('display', 'block');
            $('#popup'+dataProd.id_produit).css('display', 'block');    
        });

        // Le bouton annuler permet de faire disparaître la popup
        $('#btnCancel'+dataProd.id_produit).click(function(){
            $('#popupContainer'+dataProd.id_produit).css('display', 'none');
        });

        // mise a jour du produit
        $('#btnMettreAjourProduit'+dataProd.id_produit).click(function(){
            mettreAjourProduit(dataProd.id_produit);
        });

        //supression du produit
        $('#btnSupprimerProduit'+dataProd.id_produit).click(function(){
            if (confirm('Voulez-vous supprimer ce produit ?')) {
                supprimerProduit(dataProd.id_produit);
            }
        });




    });











    
    
    



    alert("produit ajouté");                // <==== pas encore ajouté
    return true;        

}