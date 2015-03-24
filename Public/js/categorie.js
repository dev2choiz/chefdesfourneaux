$("document").ready(function(){
    $("#divCom").hide();
    $("#btnAddCom").click(function(){
        $("#divCom").show('slow');
        return false;
    });
});