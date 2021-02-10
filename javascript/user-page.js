$(function(){
    
    $("#open-btn").click(function(){
        $("#right-wrapper").fadeToggle(500);
    });

    $("#user-post").click(function(){
        $(this).toggleClass("on");
        $("#like-post").removeClass("on");
        $(".user-posts").toggleClass("show");
        $(".like-posts").removeClass("show");
    });

    $("#like-post").click(function(){
        $(this).toggleClass("on");
        $("#user-post").removeClass("on");
        $(".like-posts").toggleClass("show");
        $(".user-posts").removeClass("show");
    });
    
});