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
    //
    $(prefixId+'add').on('click', function (event) {
        usuario_listado_modal_add();
    });
    $(prefixId+'tabla').on('click', '.edit', function (event) {
        usuario_listado_modal_edit($(this));
    });
    $(window).on('closed.zf.reveal', function () {
        usuario_listado_modal_close();
    });
    //
    $(prefixId+'tabla').on('change', '.item-vigente-tbl', function (event) {
        usuario_listado_change_vigente($(this));
    });
    // 
    $('body').on('click', 'form.myform a.save-exit', function (e) {
        
        usuario_listado_modal_save_exit();  
    });
    $('body').on('click', 'form.myform a.reseteo-pwd', function (e) {
        usuario_listado_modal_reseteo_pwd();  
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
            'usuario_id': '0',
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/usuario_listado_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function usuario_listado_modal_edit(item) {
        var enviar = {
            'usuario_id': item.attr('usuario_id'),
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/usuario_listado_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function usuario_listado_modal_close() {
        // $('tr' ).removeClass('active');
        var item = $('#field_usuario_id').val();
        $('.item-datatable').parent().parent().removeClass('active');
        $('.item-datatable-' + item).parent().parent().addClass('active');
    }
    //
    function usuario_listado_change_vigente(item) {
        var enviar = {
            'vigente': item.val(),
            'usuario_id': item.attr('usuario_id'),
        }
        // c(enviar);
        none_simple(
            './procesos/ajax/change/usuario_listado_td_vigente_change.php',
            enviar
        );
        item.parent().parent().parent().addClass('active');
    }
    //
    function usuario_listado_modal_save_exit() {
        var enviar = $("form.myform").serialize();
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/save/usuario_listado_venta_click_save.php',
	    success: function(data) {
                // dataTable_listado.draw();
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
    function usuario_listado_modal_reseteo_pwd() {
        var enviar = {
            'usuario_id': $('#field_usuario_id').val()
        }
        none_simple(
            './procesos/ajax/click/usuario_listado_modal_pwd_click.php',
            enviar
        );
        alert('Contraseña Reseteada');
    }
});
