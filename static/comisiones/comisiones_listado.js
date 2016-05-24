$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#comisiones_listado_';
    var prefixClass = '.comisiones_listado_';
    
    // --------------------------------------------------------------- LOAD
    comisiones_listado_combos();
    // ------------------------------------------------------------ EVENTOS
    // $(prefixId+'tabla .reload').on('click', function (event) {
    // });
    // ----------------------------
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
});
