$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#comisiones_listado_';
    var prefixClass = '.comisiones_listado_';
    
    // --------------------------------------------------------------- LOAD
    comisiones_listado_combos();
    // ------------------------------------------------------------ EVENTOS
    $('#export-excel').on('click', function (event) {
        comisiones_listado_excel($(this));
    });

    
    // ---------------------------------------------------------- FUNCIONES
    function comisiones_listado_combos() {
        var enviar = {
            'campania_id': $('#campania_id').val()
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/select/comisiones_listado_campaniaXusuario.php',
            '#campania_id',
            enviar
        );
    }
    function comisiones_listado_excel(item) {
        var enviar = {
            'campania_id': $('#campania_id').val(),
            'fecha': $('#anio-mes').val(),
        }
        // c(enviar);
        var enlace = '';        
        enlace+= 'procesos/ajax/click/comisiones_listado_excel.php?';
        enlace+= 'campania_id=' + enviar.campania_id + '&';
        enlace+= 'fecha=' + enviar.fecha ;
        item.attr('href', enlace);
        
    }
});
