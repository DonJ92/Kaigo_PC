var calendar = new ej.calendars.Calendar({
    isMultiSelection: true,
});
calendar.appendTo('#register-element');

function onTimeDialog() {
    var dates = calendar.values;

    if (dates == null)
        toastr.error('期間をご選択ください。', '', { "closeButton": true });
    else
    {
        var period = new Array(dates.length);

        for (var i = 0; i < dates.length; i++)
            period[i] = dates[i].getFullYear() + '/' + (dates[i].getMonth() + 1) + '/' + dates[i].getDate();

        $('#period').val(period);

        $('#dialog-box').css({
            top: (window.innerHeight - ($('#dialog-box').height() * 2)),
            left: ((window.innerWidth / 2) - ($('#dialog-box').width() / 2))
        }).show();
    }
}