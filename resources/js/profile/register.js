$("#sel_client").click(function(){
    $("#sel_worker").removeClass("active");
    if (!$("#sel_client").hasClass("active"))
        $("#sel_client").addClass("active");
});

$("#sel_worker").click(function(){
    $("#sel_client").removeClass("active");
    if (!$("#sel_worker").hasClass("active"))
        $("#sel_worker").addClass("active");
});