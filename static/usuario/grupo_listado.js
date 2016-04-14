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
    $(prefixId+'tabla-grupo').on('click', '.edit', function (event) {
        grupo_listado_modal_edit($(this));
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
    function grupo_listado_modal_edit(item) {
        var enviar = {
            'grupo_id': item.attr('grupo_id'),
        }
        dataTable_listado_grupo
            .search(enviar.grupo_id)
            .draw();
        dataTable_listado_grupo
            .search('');
        var myVar = setInterval(function() {
            $(prefixId+'tabla-grupo .item-datatable-' + enviar.grupo_id).parent().parent().addClass('active');
            clearInterval(myVar);
	}, 1000);
    }
    
});
