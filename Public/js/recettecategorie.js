


$(document).ready(function(){

        $('#addCommentaire').click(function(){
           //document.getElementById("commValue").text="fjskfjd";
            //document.getElementById("commValue").__load
            alert("avant le if" +tinyMCE.get('commValue').getContent()+"##");
            if ($("#commValue").html()!=="") {
                alert("dans le if");
                ajouterCommentaire(document.getElementById("commValue").value, $("#noteValue").val());
            }
        });
    }
);


function ajouterCommentaire(value, note){
    alert(value+ "   "+ note);
    jsonData = 
    {
        'service'   : 'commentaire',
        'method'    : 'insertCommentaire',
        'value'     : value,
        'note'      : note
    };

    script="";

    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async :true,
        success: function(data) {

            idComm = parseInt((data.response));
            console.log(idComm);
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
        dataType: 'json',
        success: function(data) {
            console.log(data.response);

            html="<hr>";/*\
                    <div>\
                        <p>"+data.response.value+"</p>\
                        <p>"+data.response.note+" / 5</p>\
                        <p>"+data.response.pseudo+"</p>\
                        <p>"+data.response.update+"</p>\
                    </div>";*/

            $('#WrapperComms').append(html);


        }
    });
}


