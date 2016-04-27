var timestamp_estructura = 0;

function timer_estructura() {
    // console.log(timestamp_estructura);
    $.ajax({
        async:true,
        type: "POST",
        url: "./procesos/ajax/timer/ventas_listado_estructura_timer.php",
        dataType:"html",
        success: function(data) {
            timestamp_tmp = data.trim();
            if(timestamp_estructura != timestamp_tmp && timestamp_tmp != '-1') {
                $('#venta_listado_timer').show();
                timestamp_estructura = timestamp_tmp;
                timer_estructura_reporte();
                // console.log(timestamp_estructura);
            }
            if (timestamp_tmp != '-1') {
                setTimeout('timer_estructura()',12000);
            }
        }
    });
}
function timer_estructura_reporte() {
    $.ajax({
        async:true,
        type: "POST",
        url: "./procesos/ajax/timer/ventas_listado_estructura_reporte.php",
        dataType:"html",
        success: function(data) {
            var jsn = jQuery.parseJSON( data );

            if (jQuery.isPlainObject(jsn)) {
                $('.timer-tramitacion').show();
                $('.timer-tramitacion a.item-1').html(jsn.dato01);
                $('.timer-tramitacion a.item-2').html(jsn.dato02);
                $('.timer-tramitacion a.item-3').html(jsn.dato03);
                // c(jsn);
            }
        }
    });
}

$(document).ready(function() {

    
    // --------------------------------------------------------------- LOAD
    timer_estructura();

    
    // ------------------------------------------------------------ EVENTOS
    $( ".timer-tramitacion a" ).hover(function() {
        var item = $(this).attr('item');
        $(".timer-tramitacion span").removeClass('active');
        $(".timer-tramitacion span.item-"+item).addClass('active');
        $(".timer-tramitacion a").removeClass('active');
        $(this).addClass('active');
    });
    
});
