

$(document).ready(function(){
        $('#addCommentaire').click(function(){
            if (tinyMCE.get('commValue').getContent()!=="") {
                ajouterCommentaire(tinyMCE.get('commValue').getContent());
            }
        });
    }
);


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


/* <div class="panel panel-default headerCom">
                <div class="panel-heading">
                    Na 
                    <span class="badge">
                        1 / 5
                    </span>
                </div>
                <div class="panel-body">
                    <p><p>nouveau com3</p></p>
                    
                                        <p>19-04-2015  16:23</p>
                    <p></p>
                </div>
            </div>
*/
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


