$(document).ready(function() {
    var prefixId = '#usuario_listado_';
    var prefixClass = '.usuario_listado_';
    var dataTable_listado_grupo = '';
    // --------------------------------------------------------------- LOAD
    grupo_listado_tabla();

    
    // ---------------------------------------------------------------
    $(prefixId+'tabla-grupo .reload').on('click', function (event) {
        grupo_listado_reload();
    });
    $(prefixId+'tabla-grupo .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();
        if (event.which == 13) {
            dataTable_listado_grupo.columns(i).search(v).draw();
            if (v=='') {
                $(this).removeClass('active');               
            } else {
                $(this).addClass('active');
            }
        }
    });
    $(prefixId+'tabla-grupo .search-input-select').on( 'change', function () {
        var i =$(this).attr('data-column');
	var v =$(this).val();
        dataTable_listado_grupo.columns(i).search(v).draw();
        if (v=='') {
            $(this).removeClass('active');               
        } else {
            $(this).addClass('active');
        }
    });
    //
    $(prefixId+'add-grupo').on('click', function (event) {
        grupo_listado_modal_add();
    });
    $(prefixId+'tabla-grupo').on('click', '.edit', function (event) {
        grupo_listado_modal_edit($(this));
    });
    $(window).on('closed.zf.reveal', function () {
        if ( $(prefixId+'modal_div2').attr('modelo') == 'grupo' ) {
            grupo_listado_modal_close();
        }        
    });
    //
    $('body').on('click', 'form.myform-grupo a.save-exit', function (e) {
        grupo_listado_modal_save_exit();  
    });
    
    // ---------------------------------------------------------------
    function grupo_listado_tabla() {
        
        dataTable_listado_grupo = $(prefixId+'tabla-grupo').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            "info": false,
            "pageLength" : 20,
            "aoColumnDefs": [
                { 'aTargets': [ 3 ], 'bSortable': false },
            ],

            "ajax": {
                url :"./procesos/ajax/table/grupo_listado_datatable.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla-grupo_filter').hide();
    }
    function grupo_listado_reload() {
        dataTable_listado_grupo.draw();
    }
    //
    function grupo_listado_modal_add() {
        var enviar = {
            'grupo_id': '0',
        }
        // c(enviar);
        $(prefixId+'modal_div2').attr('modelo','grupo');
        element_simple(
            './procesos/ajax/click/grupo_listado_modal.php',
            prefixId+'modal_div2 .ajax',
            enviar
        );
    }
    function grupo_listado_modal_edit(item) {
        var enviar = {
            'grupo_id': item.attr('grupo_id'),
        }
        $(prefixId+'modal_div2').attr('modelo','grupo');
        element_simple(
            './procesos/ajax/click/grupo_listado_modal.php',
            prefixId+'modal_div2 .ajax',
            enviar
        );
        // dataTable_listado_grupo
        //     .search(enviar.grupo_id)
        //     .draw();
        // dataTable_listado_grupo
        //     .search('');
        // var myVar = setInterval(function() {
        //     $(prefixId+'tabla-grupo .item-datatable-' + enviar.grupo_id).parent().parent().addClass('active');
        //     clearInterval(myVar);
	// }, 1000);
    }
    function grupo_listado_modal_close() {
        // $('tr' ).removeClass('active');
        var item = $('#field_grupo_id').val();
        $(prefixId + 'tabla-grupo .item-datatable').parent().parent().removeClass('active');
        $(prefixId + 'tabla-grupo .item-datatable-' + item).parent().parent().addClass('active');
    }
    //
    function grupo_listado_modal_save_exit() {
        var enviar = $("form.myform-grupo").serialize();
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/save/grupo_listado_click_save.php',
	    success: function(data) {
                // dataTable_listado.draw();
                dataTable_listado_grupo
                    .search(data)
                    .draw();
                dataTable_listado_grupo
                    .search('');
                var myVar = setInterval(function() {
                    $(prefixId+'tabla-grupo .item-datatable-' + data).parent().parent().addClass('active');
                    clearInterval(myVar);
		}, 1000);
            }
        });
    } 
});
