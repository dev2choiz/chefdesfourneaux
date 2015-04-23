
$(document).ready(function(){
    //definit la taille de base au chargement de la pasge
    $(".imgProduits").attr('tailleImg', '1600');
});

window.onload = fillSize;
window.onresize = fillSize;

function fillSize(event){
    //Donne la taille de la fenêtre
    var dimension = event.currentTarget.innerWidth;
    
    /*if(dimension>1600){
        changeImages("1600");
    }
    else */if(dimension>1200){
        changeImages("1600");
    }
    else if(dimension>990){
        changeImages("1200");
    }
    else if(dimension>768){
        changeImages("990");
    }
    else if(dimension>480){
        changeImages("768");
    }
    else{
        changeImages("282");
    }
}

function changeImages(taille){


    $(".imgProduits").each(function(){

        tailleActuelle = $(this).attr('tailleImg');

        newSrc=$(this).attr('src').replace(tailleActuelle, taille);
        $(this).attr('src', newSrc);
        $(this).attr('tailleImg', taille);

    });


}