window.onload = fillSize;
window.onresize = fillSize;

function fillSize(event){
    //Donne la taille de la fenêtre
    var dimension = event.currentTarget.innerWidth;
    
    if(dimension>990){
        changeImages("big");
    }
    else if(dimension>768){
        changeImages("normal");
    }
    else{
        changeImages("small");
    }
}

function changeImages(taille){
    var balisesImg      = document.getElementsByTagName('img');
    var regNomImg       = /Img\/(big|normal|small)\-/;
    var regPartchange   = /(big|normal|small)\-/;
    
    for(var i=0; i<balisesImg.length; i++){
        //Vérifie que l'image est bien à changer
        if(regNomImg.test(balisesImg[i].src)){
            balisesImg[i].src = balisesImg[i].src.replace(regPartchange, taille + '-');
        }
    }
}