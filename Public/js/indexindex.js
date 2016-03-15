liZoom = 15;
function IndexIndex(){
    // Constructeur
}

IndexIndex.prototype = {

    /**
     * Traitements lancés en fin de chargement de la page
     */
    ready : function()
    {
        $(".img-circle").mouseenter(function(e) {
            liImgWidth  = parseInt($(this).css('width'));
            liImgHeight = parseInt($(this).css('height'));
            
            liDivWidth  = parseInt($(this).parent().parent().css('width'));
            liDivHeight = parseInt($(this).parent().parent().css('height'));
            
            $(this).parent().parent().css('width', liDivWidth+'px');
            $(this).parent().parent().css('height', liDivHeight+'px');

            $(this).animate({
                width: (liImgWidth+liZoom)+'px',
                height: (liImgHeight+liZoom)+'px',
            }, 500);
        });

        $(".img-circle").mouseleave(function(e) {
            
            liImgWidth  = parseInt($(this).css('width'));
            liImgHeight = parseInt($(this).css('height'));
            $(this).css('position', 'static');
            $(this).animate({
                width: (liImgWidth-liZoom)+'px',
                height: (liImgHeight-liZoom)+'px',
            }, 500);
        });
    }, // ready

    /**
     * Token de fin
     */
    _endPrototype : null
}; // IndexIndex.prototype

//==== Définition de l'objet global goIndexIndex ====
var goIndexIndex = new IndexIndex();
$(function() {
    goIndexIndex.ready();
});
