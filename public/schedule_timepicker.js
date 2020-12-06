$(document).ready(function(){
    $('.timepicker').timepicker({
        timeFormat: "H:i",
        disableTextInput: true,
        step: 60,
        startTime: new Date(0,0,0,0,0,0),
        defaultTime: new Date(0,0,0,0,0,0),
    });
});