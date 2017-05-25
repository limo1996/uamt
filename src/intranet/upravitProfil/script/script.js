$(document).ready(function() {
    $('#ldaplogin input').blur(function()
    {
        document.getElementById("permissions").style.display = "none";
    });

    //$.trim($("#ldaplogin").val()).length > 0
    //{

    //}

    $('#ldaplogin').keyup(function(){
        if($.trim($('#ldaplogin').val()).length > 0)
            document.getElementById("permissions").style.display = "block";

        else
            document.getElementById("permissions").style.display = "none";
    });


        if($.trim($('#ldaplogin').val()).length > 0)
            document.getElementById("permissions").style.display = "block";

        else
            document.getElementById("permissions").style.display = "none";


});