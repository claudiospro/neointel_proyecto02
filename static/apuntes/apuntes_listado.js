$(document).ready(function() {
    var prefixId = '#apuntes_listado_';
    var prefixClass = '.apuntes_listado_';
    var dataTable_listado = '';
    // --------------------------------------------------------------- LOAD
    apuntes_listado_tabla(0);

    // ------------------------------------------------------------ EVENTOS
    $(prefixId+'add').on('click', function (event) {
        apuntes_listado_modal($(this));

    });
    $(prefixId+'principal').on('click', '.item a', function (event) {
        apuntes_listado_modal($(this));

    });
    $(prefixId+'modal').on('click', '.formulario .apunte-save', function (event) {
        apuntes_listado_modal_save();
    });
    // paginacion
    $(prefixId+'paginacion').on('click', '.prev', function (event) {
        var pagina =  parseInt($(prefixId + 'principal').attr('pagina'));
        if (pagina > 0)
            pagina -= 1
        apuntes_listado_tabla( pagina );
    });
    $(prefixId+'paginacion').on('click', '.next', function (event) {
        var pagina =  parseInt($(prefixId + 'principal').attr('pagina'));
        var enviar = {
            'pagina': pagina + 1,
            'search_ini': $('#search_ini').val(),
            'search_end': $('#search_end').val(),
            'search_pendiente': $('#search_pendiente').val(),            
        };
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './procesos/ajax/none/apuntes_listado_verificar_pagina.php',
	    success: function(pagina) {
                // c(pagina);
                apuntes_listado_tabla(pagina);
            }
        });
    });
    // busqueda
    $(prefixId+'modal_search').on('change', 'input, select', function (event) {
        apuntes_listado_tabla(0);
    });
    $(prefixId+'modal_search').on('click', '.input-group-label', function (event) {
        apuntes_listado_tabla(0);
    });
    // ---------------------------------------------------------- FUNCIONES
    function apuntes_listado_tabla(pagina) {
        var enviar = {
            'pagina': pagina,
            'search_ini': $('#search_ini').val(),
            'search_end': $('#search_end').val(),
            'search_pendiente': $('#search_pendiente').val(),            
        };
        // c(enviar);
        element_simple(
            './procesos/ajax/table/apuntes_litado_principal.php',
            prefixId+'principal',
            enviar
        );
        $(prefixId + 'principal').attr('pagina', pagina);
    }
    function apuntes_listado_modal (item) {
        var enviar = {
            'id': item.attr('item')
        }
        // c(enviar);
        element_simple(
            './procesos/ajax/modal/apuntes_listado_item.php',
            prefixId+'modal .ajax',
            enviar
        );
    }
    function apuntes_listado_modal_save() {
        var enviar = {
            'id'   : $('.formulario .apunte-id').val(),
            'texto': tinyMCE.activeEditor.getContent(),
            'pendiente': $('.formulario .apunte-pendiente').val(),
            'telefono': $('.formulario .apunte-telefono').val(),
        }
        // c(enviar);
        none_simple(
            './procesos/ajax/save/apuntes_listado_modal_save.php',
            enviar
        );

        if (enviar.id == '0')
            var pagina = 0;
        else
            var pagina = $(prefixId + 'principal').attr('pagina');
        apuntes_listado_tabla(pagina);        
    }
});
