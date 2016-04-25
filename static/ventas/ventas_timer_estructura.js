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
                setTimeout('timer_estructura()',15000);
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
            $('#venta_listado_timer tbody')
                .empty()
                .html(data);
        }
    });
}

$(document).ready(function() {
    timer_estructura();
});
