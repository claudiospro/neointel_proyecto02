$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#venta_listado_';
    var prefixClass = '.venta_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    venta_listado_tabla();
    venta_listado_campanias();
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
    $(prefixId+'tabla').on('click', '.view', function (event) {
        venta_listado_modal_edit($(this));
    });
    $(prefixId+'add').on('click', function (event) {
        venta_listado_modal_add();
    });
    $('body').on('click', 'form.myform a', function (event) {
        venta_listado_modal_save();
    });


    // ---------------------------------------------------------- FUNCIONES
    function venta_listado_tabla() {
        var enviar = {
            'perfil': $(prefixId+'perfiles').val()
        };
        var ver = [];

        if(enviar.perfil == 'Asesor Comercial') {
            ver = [6, 7, 8, 9];
        } else if(enviar.perfil == 'Supervisor') {
            ver = [8, 9];
        } else if(enviar.perfil == 'Tramitacion') {
            ver = [7, 9];
        } else if(enviar.perfil == 'Coordinador') {
            ver = [9];
        } else {
             ver = [];
        }
        dataTable_listado = $(prefixId+'tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            // "searching": false,
            "info": false,
            //"bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength" : 50,
            "order"      : [ 4, 'desc' ],
            "aoColumnDefs": [
                { 'aTargets': [ 10 ], 'bSortable': false },
                { "targets": ver, "visible": false }
            ],

            "ajax": {
                url :"./procesos/ajax/table/ventas_listado_datatable.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
    function venta_listado_modal_edit(item) {
        var enviar = {
            'campania': item.attr('campania'),
            'venta_id': item.attr('venta_id'),
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/ventas_listado_view_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function venta_listado_modal_add() {
        var enviar = {
            'campania': $(prefixId+'campanias').val(),
            'venta_id': '0',
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/ventas_listado_view_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function venta_listado_modal_save() {
        var enviar = $("form.myform").serialize();
        none_simple('./procesos/ajax/save/ventas_listado_venta_click_save.php',
                    enviar
                   );
    }
    function venta_listado_campanias() {
        var enviar = {}
        element_simple(
            './procesos/ajax/select/ventas_listado_campanias_onload.php',
            prefixId+'campanias',
            enviar
        );
    }
});
