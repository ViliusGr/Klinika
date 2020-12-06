console.log("time picker loaded")

let $doctor = $("#appointment_doctor")
let $date =  $("#appointment_date")
let $token = $("#appointment__token")

$(document).ready(function(){
    $('.timepicker').timepicker({
        timeFormat: "H:i",
        disableTextInput: true
    });
});

$doctor.change(function(){
    updateTimes()
})
$date.change(function(){
    updateTimes()
})

function updateTimes(){
    $(".timepicker").val('')
    var $form = $(this).closest('form')
    var data = {}

    data[$token.attr('name')] = $token.val()
    data[$doctor.attr('name')] = $doctor.val()
    data[$date.attr('name')] = $date.val()
    let tvalue = $token.val()
    let docvalue = $doctor.val()
    let davalue = $date.val()


    let route = $('div[data-route]').data('route')

    if(docvalue && davalue){
        $.ajax({
            url: route,
            type: 'POST',
            dataType: "json",
            data:{
                "doctor": docvalue,
                "date": davalue
            },
            async: true,
            success: function (data) {
                console.log(data)
                let times = data['unavailable_times']
                let unvTimes = []
                for (i = 0; i < times.length; i+=2){
                    unvTimes.push([times[i], times[i + 1]])
                }

                if(data['time_from'] == data['time_to']){
                    unvTimes.push(["00:00", "23:59"])
                }
                console.log(unvTimes)
                $('.timepicker').timepicker('option', 'minTime', data['time_from'])
                $('.timepicker').timepicker('option', 'maxTime', data['time_to'])
                $('.timepicker').timepicker('option', 'step', data['interval'])
                $('.timepicker').timepicker('option', 'startTime', data['time_from'])
                $('.timepicker').timepicker('option', 'disableTimeRanges', unvTimes)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log("error", textStatus)
            }
        })
    }

}



