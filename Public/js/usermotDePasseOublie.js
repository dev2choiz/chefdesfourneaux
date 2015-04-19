

$(document).ready(function(){

        $('#id_questionsecrete').hide();
        $( "#id_questionsecrete" ).prop( "disabled", true );

        alert("dkj");
        $('#mail').blur(function(){
            
            mail=$('#mail').val();

            
            if (true /*Verif format mail ici*/) {

                alert(mail);
                idQuestUser=questionUser(mail);
                console.log("idq",idQuestUser);
                if(idQuestUser>0 ){

                    $('#id_questionsecrete option[value="'+idQuestUser+'"]').prop('selected', true);
                    $("#id_questionsecrete").show('slow');

                    //chargerQuestions(mail, idQuestUser);
                }else{
                    alert("le mail n'existe pas dans la base");
                }

            } else{
                alert("le format du mail n'est pas bon");
            };
            
            

        });
    }
);






function questionUser(mail){
    //

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

function chargerQuestions(mail, idQuestUser){


    jsonData = 
    {
        'service'       : 'QuestionSecrete',
        'method'        : 'getQuestionSecretes',
        'id_com'        : mail
    };



    $.ajax({
        type: 'POST',
        data: jsonData,
        url: urlWebService,
        dataType: 'json',
        async:false,
        success: function(data) {
            console.log("les question",data.response);
            $("#id_questionsecrete").empty();
            for (var i = 0; i < data.response.length; i++) {
                $("#id_questionsecrete").append("<option value='"+data.response[i]['id_questionsecrete']+"'>"+data.response[i]['value']+"</option>");
            };

            $('#id_questionsecrete option[value="'+idQuestUser+'"]').prop('selected', true);
            $("#id_questionsecrete").show('slow');
            
            

        }
    });

    return true;
}


