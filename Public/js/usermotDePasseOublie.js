

$(document).ready(function(){

        $('#id_questionsecrete').hide();
        $( "#id_questionsecrete" ).prop( "disabled", true );

        //alert("dkj");
        $('#mail').blur(function(){
            
            mail=$('#mail').val();
            
            if (true /*Verif format mail ici*/) {
                idQuestUser=questionUser(mail);
                
                if(idQuestUser>0 ){

                    $('#id_questionsecrete option[value="'+idQuestUser+'"]').prop('selected', true);
                    $("#id_questionsecrete").show('slow');
                    
                }else{
                    $("#msgError").html("le mail n'existe pas dans la base");
                    
                }

            } else{
                $("#msgError").html("le format du mail n'est pas bon");
                
            };
            
            

        });
    }
);






function questionUser(mail){

    jsonData = 
    {
        'service'       : 'QuestionSecrete',
        'method'        : 'getQuestionSecreteUser',
        'mail'        : mail
    };

    var retour=null;
    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {
            console.log("sa question",data.response);
            retour=data.response;
        }
    });

    return retour;
}

