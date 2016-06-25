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
        if ( $(prefixId+'modal_div').attr('modelo') == 'usuario' ) {
            usuario_listado_modal_close();
        }        
    });
    //
    $(prefixId+'tabla').on('change', '.item-vigente-tbl', function (event) {
        usuario_listado_change_vigente($(this));
    });
    //
    $('body').on('change', 'form.myform  #field_perfil_id', function (event) {
        usuario_listado_modal_perfil_id($(this));
    });
    // 
    $('body').on('click', 'form.myform a.save-exit', function (e) {
        return usuario_listado_modal_save_exit();
    });
    $('body').on('click', 'form.myform a.reseteo-pwd', function (e) {
        usuario_listado_modal_reseteo_pwd();  
    });
    $('body').on('change', '.item-grupo', function (event) {
        usuario_listado_modal_grupo_checkbox($(this));
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
            
            "pageLength" : 8,
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
        $(prefixId+'modal_div').attr('modelo','usuario');
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
        $(prefixId+'modal_div').attr('modelo','usuario');
        element_simple(
            './procesos/ajax/click/usuario_listado_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function usuario_listado_modal_close() {
        // $('tr' ).removeClass('active');
        var item = $('#field_usuario_id').val();
        $(prefixId + 'tabla .item-datatable').parent().parent().removeClass('active');
        $(prefixId + 'tabla .item-datatable-' + item).parent().parent().addClass('active');
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
        var out = true;
        var enviar = $("form.myform").serialize();
        // c(enviar);
        var validar = [] ;
        var fechas = {
            'vigente': $('#field_modal_usuario_vigente').is(':checked'),
            'entrada': $('#field_modal_usuario_fecha_entrada').val(),
            'cese'   : $('#field_modal_usuario_fecha_cese').val(),
        }
        // c(fechas);
        if (fechas.vigente == true && fechas.entrada == '') {
            out = false;
            alert('Para que este VIGENTE debe indicar FECHA_ENTRADA');
        }
        if (fechas.vigente == true && fechas.cese != '') {
            out = false;
            alert('Para que este VIGENTE debe estar vacio FECHA_CESE');
            $('#field_modal_usuario_fecha_cese').val('');
        }
        if (fechas.vigente == false && fechas.cese == '') {
            out = false;
            alert('Para que este CESADO debe indicar FECHA_CESE');
        }
        
        validar['tot'] = 0 ;
        $('.item-grupo').each(function(){
            if($(this).is(':checked')) { 
                validar['tot'] = validar['tot'] +1;
            }
        });
        validar['perfil_id'] = $('#field_perfil_id').val();
        
        if (validar['tot'] > 1 && validar['perfil_id'] == '4') {
            out = false;
            alert('Solo seleccione un Grupo');
        }
        if (validar['tot'] > 1 && validar['perfil_id'] == '5') {
            out = false;
            alert('Solo seleccione un Grupo');
        }
        if (validar['tot'] > 0 && validar['perfil_id'] == '2') {
            out = false;
            alert('No puede pertenece a un grupo');
        }
        if (validar['tot'] > 0 && validar['perfil_id'] == '10') {
            out = false;
            alert('No puede pertenece a un grupo');
        }
        if (validar['tot'] == 0 && validar['perfil_id'] != '2'
            && validar['perfil_id'] != '10'
           )
        {
            out = false;
            alert('Debe pertenecer a un grupo');
        }
        
        if (out) {
            $.ajax({
	        type: "POST",
	        data: enviar,
	        url: './procesos/ajax/save/usuario_listado_click_save.php',
	        success: function(data) {
                    dataTable_listado
                        .search(data)
                        .draw();
                    dataTable_listado
                        .search('');
                    var myVar = setInterval(function() {
                        $(prefixId+'tabla .item-datatable-' + data).parent().parent().addClass('active');
                        clearInterval(myVar);
		    }, 700);
                }
            });
        }

        return out;
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
    function usuario_listado_modal_perfil_id(item) {
        if (item.val() == 4 || item.val() == 6) {
            $('form.myform .validar').show();
        } else {
            $('form.myform .validar').hide();
        }
    }
    //
    function usuario_listado_modal_grupo_checkbox(item) {
        // var enviar = {
        //     'estado': item.is(':checked'),
        //     'grupo_id': item.attr('grupo_id'),
        //     'usuario_id': $('#field_usuario_id').val(),
        // }
        // // c(enviar);
        // none_simple(
        //     './procesos/ajax/change/usuario_listado_modal_grupo_change.php',
        //     enviar
        // );
    }
});
