$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#venta_listado_';
    var prefixClass = '.venta_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    venta_listado_tabla();
    venta_listado_estados();    
    // ------------------------------------------------------------ EVENTOS    
    $(prefixId+'tabla .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            dataTable_listado.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $(prefixId+'tabla .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_listado.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });
    $(prefixId+'cambiar').on('click', function (event) {
        // venta_listado_cambiar();
    });
    $('table').on( 'change', '.lista-estado-row', function () {
        venta_listado_estado_row($(this));
    });
    // ---------------------------------------------------------- FUNCIONES
    function venta_listado_tabla() {
        var enviar = {
            'perfil': $(prefixId+'perfiles').val()
        };
        dataTable_listado = $(prefixId+'tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            // "searching": false,
            "info": false,
            //"bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength" : 15,
            "order"      : [ 2, 'desc' ],
            "aoColumnDefs": [
                // { 'aTargets': [ 0 ], 'bSortable': false },
            ],

            "ajax": {
                url :"./procesos/ajax/table/ventas_listado_datatable.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
    function venta_listado_estados() {
        var enviar = {}
        element_simple(
            './procesos/ajax/select/ventas_listado_estados_select.php',
            prefixId+'estados',
            enviar
        );
        element_simple(
            '../ventas/procesos/ajax/select/ventas_listado_estado.php',
            prefixId+'estado-tbl',
            enviar
        );
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: '../ventas/procesos/ajax/select/ventas_listado_campanias_onload.php',
	    success: function(data) {
                $(prefixId+'campanias-tbl').html(data);
	    }
        });
    }
    function venta_listado_cambiar() {
        if( $('.accion:checked').length > 0 ) {
            var ids = [];
            $('.accion').each(function(){
                if($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            var enviar = {
                'estado': $(prefixId+'estados').val(),
                'ids': ids.toString()
            }
            // c(enviar);
            $.ajax({
	        type: "POST",
	        data: enviar,
	        url: './procesos/ajax/save/ventas_listado_cambiar_estado_click_save.php',
	        success: function(data) {
                    dataTable_listado
                        .search(data)
                        .draw();
                    dataTable_listado
                        .search('');
                }
            });            
        }
    }
    //
    function venta_listado_estado_row(item) {
        var enviar = {
            'campania': item.attr('campania'),
            'estado': item.val(),
            'venta': item.attr('venta'),
        }
        none_simple(
            './procesos/ajax/select/ventas_listado_estado_row_change.php',
            enviar
        );
        c(enviar);
        item.parent().parent().addClass('active');
    }
});
