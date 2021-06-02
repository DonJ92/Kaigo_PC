$("#sel_identify").click(function(){
    $("#sel_skill").removeClass("active");
    if (!$("#sel_identify").hasClass("active"))
        $("#sel_identify").addClass("active");
});

$("#sel_skill").click(function(){
    $("#sel_identify").removeClass("active");
    if (!$("#sel_skill").hasClass("active"))
        $("#sel_skill").addClass("active");
});