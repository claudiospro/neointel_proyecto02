$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#usuario_listado_';
    var prefixClass = '.usuario_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    usuario_listado_tabla();
    usuario_listado_combos();
    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'tabla .reload').on('click', function (event) {
        usuario_listado_reload();
    });
    //
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
    $(prefixId+'tabla').on('click', '.edit', function (event) {
        usuario_listado_modal_edit($(this));
    });
    $(prefixId+'tabla').on('click', '.delete', function (event) {
        usuario_listado_modal_delete($(this));
    });
    $(window).on('closed.zf.reveal', function () {
        usuario_listado_modal_close();
    });    
    $(prefixId+'add').on('click', function (event) {
        usuario_listado_modal_add();
    });
    // 
    $('body').on('click', 'form.myform a.save-exit', function (e) {
        usuario_listado_modal_save_exit();  
    });
    // ---------------------------------------------------------- FUNCIONES
    function usuario_listado_tabla() {
        
        dataTable_listado = $(prefixId+'tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            // "searching": false,
            "info": false,
            //"bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength" : 20,
            // "order"      : [ 8, 'desc' ],
            "aoColumnDefs": [
                { 'aTargets': [ 4 ], 'bSortable': false },
                // { "targets": ver, "visible": false }
            ],

            "ajax": {
                url :"./procesos/ajax/table/usuario_listado_datatable.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
    function usuario_listado_reload() {
        dataTable_listado.draw();
    }
    //
    function usuario_listado_combos() {
        var enviar = {}
        element_simple(
            './procesos/ajax/select/usuario_listado_grupo.php',
            prefixId+'grupo-tbl',
            enviar
        );
        element_simple(
            './procesos/ajax/select/usuario_listado_perfil.php',
            prefixId+'perfil-tbl',
            enviar
        );
    }
    //
    function usuario_listado_modal_add() {
        var enviar = {
            'campania': $(prefixId+'campanias').val(),
            'venta_id': '0',
            'view': '0',
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/ventas_listado_view_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function usuario_listado_modal_edit(item) {
        var enviar = {
            'campania': item.attr('campania'),
            'venta_id': item.attr('venta_id'),
            'view': '0',
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/ventas_listado_view_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function usuario_listado_modal_delete(item) {
        var perfil = $(prefixId+'perfiles').val();
        var enviar = {
            'venta_id': item.attr('venta_id')
        }
        var eliminar = confirm('¿Desea realmente eliminar Eliminar?');        
        if (eliminar) {
            none_simple(
                './procesos/ajax/delete/ventas_listado_venta_delete.php',
                enviar
            );
            // ajax cambiar (segun estado si es 1 a 0 si es 0 a 1)
            if (perfil == 'Asesor Comercial' || perfil == 'Supervisor' || perfil == 'Tramitacion' ) {
                item.parent().parent().parent().css( 'background-color', '#FEC7C7' );
                var myVar = setInterval( function(){
		    item.parent().parent().parent().remove();
                    clearInterval(myVar);
		}, 2100);
            } else {
                dataTable_listado
                    .search(enviar.venta_id)
                    .draw();
                dataTable_listado
                    .search('');
            }
        }

    }
    function usuario_listado_modal_close() {
        // $('tr' ).removeClass('active');
        var item = $('#field_venta_id').val();
        $('.item-datatable').parent().parent().removeClass('active');
        $('.item-datatable-' + item).parent().parent().addClass('active');
    }
    function usuario_listado_modal_save_exit() {
        var enviar = $("form.myform").serialize();
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/save/ventas_listado_venta_click_save.php',
	    success: function(data) {
                // $('.item-datatable-' + data).parent().parent().addClass('active');
                dataTable_listado
                    .search(data)
                    .draw();
                dataTable_listado
                    .search('');
                var myVar = setInterval(function() {
                    $('.item-datatable-' + data).parent().parent().addClass('active');
                    clearInterval(myVar);
		}, 1000);
            }
        });
    }
    //
    
});
