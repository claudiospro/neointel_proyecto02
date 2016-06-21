$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#venta_listado_';
    var prefixClass = '.venta_listado_';
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
            'venta_id': item.next().attr('venta_id'),
            'campo': item.next().attr('campo'),
        }        
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/editable/ventas_listado_table_td_field_click.php',
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
            'venta_id': item.parent().prev().attr('venta_id'),      
        }
        if (datos.campo == 'estado_real') {
            datos.valor = item.prev().val();
            datos.label = item.prev().children('option:selected').text();
        } else if (datos.campo == 'estado_observacion') {
            datos.valor = item.prev().val();
            datos.label = datos.valor;
        } else if (datos.campo == 'fecha_entrega_observacion') {
            datos.valor = item.prev().val();
            datos.label = datos.valor;
        } else if (datos.campo == 'fecha_entrega') {
            datos.valor = item.prev().val();
            datos.label = datos.valor;
        } else if (datos.campo == 'recibio_dinero_cliente') {
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
        } else if (datos.campo == 'dinero_empresa') {
            datos.valor = item.prev().val();
            datos.label = item.prev().children('option:selected').text();
        }
        // c(datos);     

        none_simple('./procesos/ajax/editable/ventas_listado_table_td_field_save.php', datos);
        
        item.parent().prev().empty().html(datos.label);        
        item.parent().hide();
        item.parent().prev().show();
        item.parent().prev().prev().show();        
    }
});
