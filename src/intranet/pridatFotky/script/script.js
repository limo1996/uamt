$(document).ready(function() {
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1 ) {
        $(function() {
            $( "#date" ).datepicker({ dateFormat: 'dd.mm.yy'});
        });
    }
});

