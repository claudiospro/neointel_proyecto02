var timestamp_por_aprobar = 0;

function timer_por_aprobar() {
    // console.log(timestamp_por_aprobar);
    $.ajax({
        async:true,
        type: "POST",
        url: "./procesos/ajax/timer/ventas_listado_por_aprobar_timer.php",
        dataType:"html",
        success: function(data) {
            timestamp_tmp = data.trim();
            if(timestamp_por_aprobar != timestamp_tmp && timestamp_tmp != '-1') {
                $('.timer-por-aprobar').show();
                timestamp_por_aprobar = timestamp_tmp;
                timer_por_aprobar_reporte();
                // console.log(timestamp_por_aprobar);
            }
            if (timestamp_tmp != '-1') {
                setTimeout('timer_por_aprobar()',15000);
            }
        }
    });
}
function timer_por_aprobar_reporte() {
    $.ajax({
        async:true,
        type: "POST",
        url: "./procesos/ajax/timer/ventas_listado_por_aprobar_reporte.php",
        dataType:"html",
        success: function(data) {
            $('.timer-por-aprobar .ajax')
                .empty()
                .html(data);
        }
    });
}

$(document).ready(function() {
    timer_por_aprobar();
});
