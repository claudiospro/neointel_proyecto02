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
            if(timestamp_estructura != timestamp_tmp) {
                timestamp_estructura = timestamp_tmp;
                // cargar_data();
                console.log(timestamp_estructura);
            }
            if (timestamp_tmp != '-1') {
                setTimeout('timer_estructura()',15000);
            }
        }
    });
}
$(document).ready(function() {
    timer_estructura();
});
