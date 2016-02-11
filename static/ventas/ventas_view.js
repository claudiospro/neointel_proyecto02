$(document).ready(function() {
    var prefixId = '#venta_item_';
    var prefixClass = '.venta_item_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD

    // ------------------------------------------------------------ EVENTOS
    $('.venta_item_autocomplete').focus(function() {
        venta_item_autocomplete($(this));
    });
    $('.venta_item_telefono').keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }        
    });
    $('.venta_item_telefono').keyup(function (e) {
        if ($(this).val().length == 9 || $(this).val().length == 0) {
            $(this).removeClass('error');
        } else {
            $(this).addClass('error');
        }
    });

    $('#venta_listado_modal_div').on('click', '.breadcrumbs a', function (event) {
        venta_item_div($(this));
    });
    $(".copy-link-wrap").click(function() {
        venta_item_zclip($(this));
    });
    // ---------------------------------------------------------- FUNCIONES
    function venta_item_autocomplete(item) {
        var my_url = './procesos/ajax/autocomplete/ventas_listado_view_autocomplete.php?';
        my_url += 'campo=' + item.attr('campo')+ '&';
        my_url += 'dependencia=' + item.attr('dependencia')+'&';
        my_url += 'dependencia_value=' + $('#field_'+item.attr('dependencia')).val()+'&';
        my_url += 'diccionario=' + item.attr('diccionario');
        item.autocomplete({
            source: my_url,
            minLength: 0,
            search: function( event, ui ) {
                item.removeClass('active');
                item.prev().val('0');
            },
            select: function( event, ui ) {            
                item.val(ui.item.label).addClass('active');
                item.prev().val(ui.item.id);
                return false;
            }
        });
    }
    function venta_item_div(item) {
        $('.venta-listado-view').hide();
        $('#venta-listado-view-' + item.attr('pestania')).show();
    }
    function venta_item_zclip(item) {
        var obj = item.find("label").eq(0).html();

        item.zclip({
            path: '../../lib/vendor/zclip/ZeroClipboard.swf',
            copy: obj,
            afterCopy: function() {
                console.log(obj);
                // alert('Dane w schowku. Możesz je teraz wklejać...');
            }
        });
    }
});
