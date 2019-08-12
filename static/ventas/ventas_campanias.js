$(document).ready(function() {
    var prefixId = '#venta_listado_';
    // --------------------------------------------------------------- LOAD

    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'campanias').on( 'change', function () {
        var url = './index.php?campania=' + $(this).val();
        window.location = url;
    });
});
