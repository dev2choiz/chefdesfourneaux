


$(document).ready(function(){

        $('#addCommentaire').click(function(){
            if (tinyMCE.get('commValue').getContent()!=="") {
                ajouterCommentaire(tinyMCE.get('commValue').getContent(), $("#noteValue").val());
            }
        });
    }
);


function ajouterCommentaire(value, note){
    alert(value+ "   "+ note);
    jsonData = 
    {
        'service'   : 'Commentaire',
        'method'    : 'insertCommentaire',
        'value'     : value,
        'note'      : note,
        'id_recette': jsIdRecette,
        'id_user'   : idUser
    };

    script="";
    alert(urlWebService);
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :false,
        success: function(data) {
            idComm = parseInt((data.response));
            
            if(idCom>0){
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

            html="<hr>\
                    <div>\
                        <p>"+data.response[0].value+"</p>\
                        <p>"+data.response[0].note+" / 5</p>\
                        <p>"+data.response[0].pseudo+"</p>\
                        <p>"+data.response[0].update+"</p>\
                    </div>";

            $('#WrapperComms').append(html);
            $("#divCom").hide('slow');

        }
    });
}


