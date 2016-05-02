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
    $('.timer-tramitacion a').on('click', function (event) {
        timer_estructura_modal($(this));
    });
    $('#timer-tramitacion_modal').on('click', '.aprobar', function (event) {
        timer_estructura_modal_save($(this));
        // venta_listado_timer_por_aprobar_save($(this));
    });

    
    // ---------------------------------------------------------- FUNCIONES
    function timer_estructura_modal(item) {
        var enviar = {
            'proceso': item.attr('item'),
            'title': $('.timer-tramitacion span.item-'+item.attr('item')).html(), 
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/ventas_listado_estructura_modal.php',
            '#timer-tramitacion_modal .ajax',
            enviar
        );
        
    }
    function timer_estructura_modal_save(item) {
        var enviar = {
            'venta_id' : item.attr('venta_id'),
            'campania' : item.attr('campania'),
            'proceso'  : $('#timer-tramitacion_modal .field_proceso').val(),
        }
        // c(enviar);
        none_simple(
            './procesos/ajax/save/ventas_listado_estructura_modal_click_save.php',
            enviar
        );              
        item.parent().parent().css( 'background-color', '#FCCB6A' );
        var myVar = setInterval( function(){
	    item.parent().parent().remove();
            clearInterval(myVar);
	}, 1800);        
    }
});
