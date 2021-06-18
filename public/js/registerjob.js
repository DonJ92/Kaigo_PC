var calendar = new ej.calendars.Calendar({
    isMultiSelection: true,
});
calendar.appendTo('#register-element');

function onTimeDialog() {
    var dates = calendar.values;

    $('#dialog-box').css({
        top: (window.innerHeight - ($('#dialog-box').height()*2)),
        left:((window.innerWidth/2) - ($('#dialog-box').width()/2))
    }).show();

    console.log(dates);
}