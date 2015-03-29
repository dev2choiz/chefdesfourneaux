


$(document).ready(function(){

        $('#addCommentaire').click(function(){
           //document.getElementById("commValue").text="fjskfjd";
            
            if (tinyMCE.get('commValue').getContent()!=="") {
                alert("dans le if"+$("#noteValue").val());
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
        dataType: 'jsonp',
        jsonpCallback: 'callback',
        async :true,
        success: function(data) {
            //console.log(data.response);
            idComm = parseInt((data.response));
            //console.log("id du comm",idComm);
            alert("dans succces ajout"+idComm);
            //console.log(data.response,"id insert :"+idComm);
            ajouterCommDansDiv(idComm);
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
        dataType: 'jsonp',
        jsonpCallback: 'callback',
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


