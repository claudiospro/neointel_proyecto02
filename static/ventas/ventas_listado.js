$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#venta_listado_';
    var prefixClass = '.venta_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    venta_listado_tabla();
    venta_listado_combos();
    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'tabla .reload').on('click', function (event) {
        venta_listado_reload();
    });
    $('#declarativo_field_export').on('click', function (event) {
        venta_listado_report($(this));
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
        venta_listado_modal_edit($(this));
    });
    $(prefixId+'tabla').on('click', '.view', function (event) {
        venta_listado_modal_view($(this));
    });
    $(prefixId+'tabla').on('click', '.delete', function (event) {
        venta_listado_modal_delete($(this));
    });
    $(window).on('closed.zf.reveal', function () {
        venta_listado_modal_close();
    });    
    $(prefixId+'add').on('click', function (event) {
        venta_listado_modal_add();
    });
    // 
    $('body').on('click', 'form.myform a.save-exit', function (e) {
        var ou = venta_listado_modal_save_validate();
        if (ou == '0') {
            e.stopPropagation();
            alert('Si Ingresas Una Terminal, Pon El Reverso del Documento');
        } else {
            venta_listado_modal_save_exit();  
        }
    });
    $('body').on('click', 'form.myform a.save-continue', function (e) {
        var ou = venta_listado_modal_save_validate();
        if (ou == '0') {
            alert('Si Ingresas Una Terminal, Pon El Reverso del Documento');  
        } else {
            venta_listado_modal_save_continue();
        }
    });
    // ----------------------------
    $('.timer-por-aprobar').on('click', 'a', function (event) {
        venta_listado_timer_por_aprobar();
    });
    $(prefixId+'modal_por_aprobar').on('click', '.edit', function (event) {
        venta_listado_modal_edit($(this));
    });
    $(prefixId+'modal_por_aprobar').on('click', '.aprobar', function (event) {
        venta_listado_timer_por_aprobar_save($(this));
    });
    $('#timer-tramitacion_modal').on('click', '.edit', function (event) {
        venta_listado_modal_edit($(this));
    });
    // ---------------------------------------------------------- FUNCIONES
    function venta_listado_tabla() {
        var enviar = {
            'perfil': $(prefixId+'perfiles').val()
        };
        var ver = [];

        if(enviar.perfil == 'Asesor Comercial') {
            ver = [5, 6, 10, 12, 13];
        } else if(enviar.perfil == 'Supervisor') {
            ver = [5, 6, 11, 12, 13];
        } else if(enviar.perfil == 'Tramitacion' ||
                  enviar.perfil == 'Tramitacion-Carga' ||
                  enviar.perfil == 'Tramitacion-Validacion' ||
                  enviar.perfil == 'Tramitacion-Validacion-Carga'
                 ) {
            ver = [12, 13];
        } else if(enviar.perfil == 'Coordinador') {
            ver = [12];
        } else if(enviar.perfil == 'Gerencia') {
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
            
            "pageLength" : 10,
            "order"      : [ 7, 'desc' ],
            "aoColumnDefs": [
                { 'aTargets': [ 14 ], 'bSortable': false },
                { "targets": ver, "visible": false }
            ],

            "ajax": {
                url :"./procesos/ajax/table/ventas_listado_datatable.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
    function venta_listado_reload() {
        dataTable_listado.draw();
    }
    function venta_listado_report(item) {
        var enviar = {
            'ini1': $('#declarativo_field_ini').val(),
            'ini2': '',
            'end1': $('#declarativo_field_end').val(),
            'end2': '',
            'campania': $('#declarativo_field_campanias').val(),
        }
        //c(enviar);
        var comparar = true;
        var enlace = '';
        
        if (enviar.ini1.trim() != '') {
            l = enviar.ini1.split("-");
            enviar.ini2 = new Date(l[0], l[1]-1, l[2]);            
        }
        if (enviar.end1.trim() != '') {
            l = enviar.end1.split("-");
            enviar.end2 = new Date(l[0], l[1]-1, l[2]);            
        }
        if (enviar.ini1.trim() == '' || enviar.end1.trim() == '') {
            
        } else {
            if (enviar.ini2 > enviar.end2) {
                comparar = false;
            }
        }
        if (comparar) {            
            enlace = 'procesos/ajax/click/ventas_listado_declarativo_excel_02.php?';
            enlace+= 'ini=' + enviar.ini1 + '&';
            enlace+= 'end=' + enviar.end1 + '&';
            enlace+= 'campania=' + enviar.campania ;
            item.attr('href', enlace);
        } else {
            a('La Fecha INICIO no puede ser MAYOR a la de FIN');
        }
    }
    //
    function venta_listado_modal_view(item) {
        var enviar = {
            'campania': item.attr('campania'),
            'venta_id': item.attr('venta_id'),
            'view': 1,
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
            'view': '0',
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/click/ventas_listado_view_modal.php',
            prefixId+'modal_div .ajax',
            enviar
        );
    }
    function venta_listado_modal_edit(item) {
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
    function venta_listado_modal_delete(item) {
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
    function venta_listado_modal_close() {
        // $('tr' ).removeClass('active');
        // var item = $('#field_venta_id').val();
        // $('.item-datatable').parent().parent().removeClass('active');
        // $('.item-datatable-' + item).parent().parent().addClass('active');
    }
    function venta_listado_modal_save_validate() {
        var ou = 1;
        if ($('#field_campania').val() == 'campania_001')
        {            
            var datos = {
                'reverso': $('#field_cliente_documento_reverso').val(),
                'movil_terminal': $('#field_movil_terminal').val(),
                'movil_adicional_1_terminal': $('#field_movil_adicional_1_terminal').val(),
                'movil_adicional_2_terminal': $('#field_movil_adicional_2_terminal').val()
            }
            // c(datos);
            
            if (datos.reverso.trim() == '' && datos.movil_terminal.trim() != '')
            {
                ou = 0;
            }
            if (datos.reverso.trim() == '' && datos.movil_adicional_1_terminal.trim() != '')
            {
                ou = 0;
            }
            if (datos.reverso.trim() == '' && datos.movil_adicional_2_terminal.trim() != '')
            {
                ou = 0;
            }
            if (ou == 0)
            {
                $('#field_cliente_documento_reverso').addClass('error');
                $('.venta-listado-view').hide();
                $('#venta-listado-view-0').show();
            } else
            {
                $('#field_cliente_documento_reverso').removeClass('error');
            }
            
        } else {
            ou = 1;
        }
        
        
        return ou;
        
    }
    function venta_listado_modal_save_continue() {
        var enviar = $("form.myform").serialize();
        // c(enviar);
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/save/ventas_listado_venta_click_save.php',
	    success: function(data) {
                $('#field_venta_id').val(data);
            }
        }); 
    }
    function venta_listado_modal_save_exit() {
        var enviar = $("form.myform").serialize();
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/save/ventas_listado_venta_click_save.php',
	    success: function(data) {
                // $('.item-datatable-' + data).parent().parent().addClass('active');
                dataTable_listado
                    // .search(data)
                    .draw();
                // dataTable_listado
                //     .search('');
                // var myVar = setInterval(function() {
                //     $('.item-datatable-' + data).parent().parent().addClass('active');
                //     clearInterval(myVar);
		// }, 1000);
            }
        });
    }
    //
    function venta_listado_combos() {
        var enviar = {}
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/select/ventas_listado_campanias_onload.php',
	    success: function(data) {
	        $(prefixId+'campanias').html(data);
                $(prefixId+'campanias-tbl').html(data);
                $('#declarativo_field_campanias').html(data);
	    }
        });
        element_simple(
            './procesos/ajax/select/ventas_listado_estado.php',
            prefixId+'estado-tbl',
            enviar
        );
        element_simple(
            './procesos/ajax/select/ventas_listado_estado_real.php',
            prefixId+'estado-real-tbl',
            enviar
        );
    }
    // --------------------
    function venta_listado_timer_por_aprobar() {
        element_simple(
            './procesos/ajax/click/ventas_listado_por_aprobar_modal.php',
            prefixId+'modal_por_aprobar .ajax',
            {}
        );
    }
    function venta_listado_timer_por_aprobar_save(item) {
        var enviar = {
            'venta_id' : item.attr('venta_id'),
            'campania' : item.attr('campania'),
        }
        none_simple(
            './procesos/ajax/save/ventas_listado_por_aprobar_modal_click_save.php',
            enviar
        );              
        item.parent().parent().css( 'background-color', '#FCCB6A' );
        var myVar = setInterval( function(){
	    item.parent().parent().remove();
            clearInterval(myVar);
	}, 1800);
    }
});
