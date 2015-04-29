

$(document).ready(function(){
        $('#addCommentaire').click(function(){
            if (tinyMCE.get('commValue').getContent()!=="") {
                ajouterCommentaire(tinyMCE.get('commValue').getContent());
            }
        });
        actualiserNoteRecette();

        var maNote=getNoteUser(idUser);
        if(maNote>0) $('#noteValue').val(maNote);

        $('#noteValue').change(function(){
            result=updateNoteUser( $('#noteValue').val() );
            console.log("reuslt update note",result);
            if ( result ) {
                alert("note prise en compte");
                actualiserNoteRecette();
            } else{
                alert("note non prise en compte");
            }
            ;
        });
});


function ajouterCommentaire(value){

    jsonData = 
    {
        'service'   : 'Commentaire',
        'method'    : 'insertCommentaire',
        'value'     : value,
        'id_recette': jsIdRecette,
        'id_user'   : idUser
    };

    script="";
    //alert(urlWebService);
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            idComm = parseInt((data.response));
            
            if(idComm>0){
                ajouterCommDansDiv(idComm);
            }else{
                alert("erreur pendant l'ajout du commentaire");
            }
            
        }

    });
}





function ajouterCommDansDiv(idComm){


    jsonData = 
    {
        'service'       : 'ViewCommentaire',
        'method'        : 'getViewCommentaire',
        'id_com'        : idComm
    };



    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        success: function(data) {
            console.log(data.response);

            html="\
            <div class='panel panel-default headerCom'>\
                    <div class='panel-heading'>\
                        "+data.response[0].pseudo+"\
                        <span class='badge'>\
                            "+data.response[0].note+" / 5\
                        </span>\
                    </div>\
                    <div class='panel-body'>\
                        "+data.response[0].value+"\
                            <p>"+data.response[0].update+"</p>\
                    </div>\
                </div>\
                ";

            $('#WrapperComms').append(html);
            $("#divCom").hide('slow');

        }
    });
}



function getNoteUser(idUser){

    jsonData = {
        'service'   : 'Note',
        'method'    : 'getNote',
        'id_user'   : idUser,
        'id_recette': jsIdRecette
    };

    $retour="";
    //alert(urlWebService);
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            $retour=data.response;
        }

    });
    return $retour;
}




function updateNoteUser(note){

    jsonData = {
        'service'   : 'Note',
        'method'    : 'updateNote',
        'id_user'   : idUser,
        'value'     : note,
        'id_recette': jsIdRecette
    };

    $retour="";
    //alert(urlWebService);
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            $retour=data.response;
        }

    });
    return $retour;
}



function actualiserNoteRecette(){

    jsonData = {
        'service'   : 'Note',
        'method'    : 'getMoyenneNote',
        'id_recette': jsIdRecette
    }

    
    
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            if (data.response>0) {
                $("#noteRecette").html(data.response);
            }
        }

    });
    
}
