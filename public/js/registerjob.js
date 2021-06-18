var calendar = new ej.calendars.Calendar({
    isMultiSelection: true,
});
calendar.appendTo('#register-element');

function onTimeDialog() {
    var dates = calendar.values;
    console.log(dates);
}