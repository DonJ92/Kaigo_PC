$("#sel_client").click(function(){
    $("#sel_helper").removeClass("active");
    if (!$("#sel_client").hasClass("active"))
        $("#sel_client").addClass("active");

    $('#type').val(1);
});

$("#sel_helper").click(function(){
    $("#sel_client").removeClass("active");
    if (!$("#sel_helper").hasClass("active"))
        $("#sel_helper").addClass("active");

    $('#type').val(2);
});