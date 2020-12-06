console.log("date picker loaded")
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd ;

$( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
        minDate: today,
        maxDate: "+14D"
    });
} );