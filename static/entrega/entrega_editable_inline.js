$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#entrega_listado_';
    var prefixClass = '.entrega_listado_';
    // --------------------------------------------------------------- LOAD
    

    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'tabla').on('click', '.editable-inline a', function () {
        editable_input($(this));
    });
    $(prefixId+'tabla').on('click', '.editable-inline button', function () {
        editable_ouput($(this));
    });
    
    // ---------------------------------------------------------- FUNCIONES
    function editable_input(item) {
        $('.editable-inline a').show();
        $('.editable-inline span').show();
        $('.editable-inline div').hide();
        
        var enviar = {
            'id': item.next().attr('venta_id'),
            'campo': item.next().attr('campo'),
        }        
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/editable/entrega_listado_table_td_field_click.php',
	    success: function(data) {
                if (data != '-1') {
                    item.hide();
                    item.next().hide();
                    item.next()
                        .next()
                        .empty()
                        .show()
                        .html(data);
                }
            }
        });
        // c(enviar);
    }
    function editable_ouput(item) {
        var datos = {
            'campo': item.parent().prev().attr('campo'), 
            'id': item.parent().prev().attr('venta_id'),      
        }
        if (datos.campo == 'recibio_dinero_cliente') {
            datos.valor = item.prev().val();
            datos.label = item.prev().children('option:selected').text();
        } else if (datos.campo == 'recibio_dinero_mensajero') {
            datos.valor = item.prev().val();
            datos.label = item.prev().children('option:selected').text();
        } else if (datos.campo == 'comprobante_tipo') {
            datos.valor = item.prev().val();
            datos.label = item.prev().children('option:selected').text();
        } else if (datos.campo == 'comprobante_numero') {
            datos.valor = item.prev().val();
            datos.label = datos.valor;
        }
        // c(datos);
        none_simple('./procesos/ajax/editable/entrega_listado_table_td_field_save.php', datos);
        
        item.parent().prev().empty().html(datos.label);        
        item.parent().hide();
        item.parent().prev().show();
        item.parent().prev().prev().show();        
    }
});
