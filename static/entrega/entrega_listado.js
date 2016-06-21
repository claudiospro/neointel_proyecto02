$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#entrega_listado_';
    var prefixClass = '.entrega_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    entrega_listado_tabla();
    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'campanias').on( 'change', function () {
        var url = './index.php?campania=' + $(this).val();   
        window.location = url;
    });
    $(prefixId+'tabla .reload').on('click', function (event) {
        dataTable_listado.draw();
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
    // ---------------------------------------------------------- FUNCIONES
    function entrega_listado_tabla() {
        var enviar = {
            'perfil':   $(prefixId+'perfiles').val() ,
            'campania': $(prefixId+'campanias').val() ,
        };
        // c(enviar);
        var ver = [];
        var order = '';
        var unsortable = [];
        var lugar = '';
        if (enviar.campania == 'campania_003')
        {            
            order = 1;
            unsortable = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
            lugar = '_003';
            if(enviar.perfil == 'Tramitacion' ||
                    enviar.perfil == 'Tramitacion-Carga' ||
                    enviar.perfil == 'Tramitacion-Validacion' ||
                    enviar.perfil == 'Tramitacion-Validacion-Carga') ver = [];
            else if(enviar.perfil == 'Gerencia') ver = [];
        }
        // else if (enviar.campania == 'campania_000')
        // {
        // }

        dataTable_listado = $(prefixId+'tabla').DataTable({
            'processing' : true,
            'serverSide' : true,
            'lengthChange': false,
            'info': true,
            'pageLength' : 10,
            'order'      : [ order, 'desc' ],
            'aoColumnDefs': [
                { 'aTargets': unsortable, 'bSortable': false },
                { 'targets': ver, 'visible': false }
            ],

            'ajax': {
                url :'./procesos/ajax/table/entrega_listado_datatable' + lugar + '.php',
                type: 'post',
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
});
