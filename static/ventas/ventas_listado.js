$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#venta_listado_';
    var prefixClass = '.venta_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    ubigeo_direcciones_tabla ();
    
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
    // $(prefixId+'').on('click', function () {
    //     ubigeo_tree_list_a_edit_save();
    // });

    // ---------------------------------------------------------- FUNCIONES
    function ubigeo_direcciones_tabla () {
        var enviar = {
            'perfil': $(prefixId+'perfiles').val()
        };
        var ver = [];

        if(enviar.perfil == 'Tramitacion') {
            ver = [6];
        } else if(enviar.perfil == 'Supervisor') {
            ver = [5];
        } else if(enviar.perfil == 'Asesor Comercial') {
             ver = [5, 6, 7];
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
            "order"      : [ 0, 'desc' ],
            "aoColumnDefs": [
                { 'aTargets': [ 13 ], 'bSortable': false },
                { "targets": ver, "visible": false }
            ],

            "ajax": {
                url :"./procesos/ajax/table/ventas_listado_datatable.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
});
