$(function(){

    $("#open-btn").click(function(){
        $("#right-wrapper").fadeToggle(500);
    });

    $("#textbox").keyup(function(){
        let cnt=$(this).val().length;
        $("#inputlength").text(cnt);
    });
});