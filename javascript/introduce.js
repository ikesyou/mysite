$(function(){

    function openModal(btn,modal){
        $(btn).click(function(){
            $(modal).slideToggle(500);
        });
    };

    $("#open-btn").click(function(){
        $("#right-wrapper").fadeToggle(500);
    });

    openModal(".use",".use-content");
    openModal(".function",".function-content");
    openModal(".terms",".terms-content");
    openModal(".question",".question-content");
});