$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#reporte_01_ventas_';
    var prefixClass = '.reporte_01_ventas_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    reporte_01_campania_id();
    
    reporte_01_supervisor_id();
    reporte_01_asesor_comercial_id();
    
    // ------------------------------------------------------------ EVENTOS
    $('#campania_id').on('change', function (event) {
        reporte_01_supervisor_id();
        reporte_01_asesor_comercial_id();
    });
    $('#anio-mes-ini').on('change', function (event) {
        reporte_01_supervisor_id();
        reporte_01_asesor_comercial_id();
    });
    $('#dia-ini').on('change', function (event) {
        reporte_01_supervisor_id();
        reporte_01_asesor_comercial_id();
    });
    $('#anio-mes-end').on('change', function (event) {
        reporte_01_supervisor_id();
        reporte_01_asesor_comercial_id();
    });
    $('#dia-end').on('change', function (event) {
        reporte_01_supervisor_id();
        reporte_01_asesor_comercial_id();
    });
    $('#supervisor_id').on('change', function (event) {
        reporte_01_asesor_comercial_id();
    });
    
    // ---------------------------------------------------------- FUNCIONES
    function reporte_01_campania_id() {
        var enviar = {
            'campania_id':  $('#campania_id').val(),
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/select/reporte01venta_campania_id.php',
            '#campania_id',
            enviar
        );
    }
    function reporte_01_supervisor_id() {
        var enviar = {
            'anio-mes-ini':  $('#anio-mes-ini').val(),
            'dia-ini':       $('#dia-ini').val(),
            'anio-mes-end':  $('#anio-mes-end').val(),
            'dia-end':       $('#dia-end').val(),
            'campania_id':  $('#campania_id').val(),
            'supervisor_id': $('#supervisor_id').val(),
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/select/reporte01venta_supervisor_id.php',
            'select#supervisor_id',
            enviar
        );
    }
    function reporte_01_asesor_comercial_id() {
        var enviar = {
            'anio-mes-ini':  $('#anio-mes-ini').val(),
            'dia-ini':       $('#dia-ini').val(),
            'anio-mes-end':  $('#anio-mes-end').val(),
            'dia-end':       $('#dia-end').val(),
            'campania_id':  $('#campania_id').val(),
            'supervisor_id': $('#supervisor_id').val(),
            'asesor_comercial_id': $('#asesor_comercial_id').val(),
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/select/reporte01venta_asesor_comercial_id.php',
            '#asesor_comercial_id',
            enviar
        );
    }

});
