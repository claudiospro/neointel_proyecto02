$(document).ready(function() {
    var prefixId = '#venta_item_';
    var prefixClass = '.venta_item_';
    var dataTable_listado = '';
    
    // ------------------------------------------------------------ EVENTOS
    $('.venta_item_autocomplete').focus(function() {
        venta_item_autocomplete($(this));
    });
    $('.venta_item_telefono').keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 86 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }        
    });
    $('.venta_item_telefono').keyup(function (e) {
        if ($(this).val().length == 9 || $(this).val().length == 0) {
            $(this).removeClass('error');
        } else {
            $(this).addClass('error');
        }
    });
    $('.venta_item_banco').keydown(function (e) {
        // Ignore controls such as backspace
        var arr = [8,16,17,20,35,36,37,38,39,40,45,46,59,9];

        // Allow number
        for(var i = 48; i <= 57; i++){
            arr.push(i);
        }

        // Allow letters
        for(var i = 65; i <= 90; i++){
            arr.push(i);
        }

        if(jQuery.inArray(e.which, arr) === -1){
            e.preventDefault();
        }
    });

    // $('.venta_item_float').keydown(function (e) {
    //     // Ignore controls such as backspace
    //     var arr = [8,16,17,20,35,36,37,38,39,40,45,46,59,9];
    //     arr.push(188); // .
    //     // Allow number
    //     for(var i = 48; i <= 57; i++){
    //         arr.push(i);
    //     }
    //
    //     if(jQuery.inArray(e.which, arr) === -1){
    //         e.preventDefault();
    //     }
    // });
    $('.venta_item_float').keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) ||
            (e.keyCode == 86 && e.ctrlKey === true) ||
            (e.keyCode == 67 && e.ctrlKey === true) ||
            e.keyCode >= 188 ||
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    //
    $('#venta_listado_modal_div').on('click', '.breadcrumbs a', function (e) {
        venta_item_div($(this));
        e.preventDefault();
    });
    $(".copy-link-wrap").click(function() {
        // venta_item_zclip($(this));
    });
    //
    var timer_proceso_tramitacion = {
        'a': $('#field_aprobado_supervisor').val(),
        'b': $('#field_tramitacion_venta_validar').val(),
        'c': $('#field_tramitacion_venta_cargar').val(),
        'd': $('#field_tramitacion_postventa_validar').val(),
        'e': $('#field_tramitacion_postventa_citar').val(),
        'f': $('#field_tramitacion_postventa_intalar').val(),        
    }
    // c(timer_proceso_tramitacion);
    $('#field_aprobado_supervisor').on('change', function (event) {
        var a = $(this);
        var b = $('#field_tramitacion_venta_validar');
        var c = $('#field_tramitacion_venta_cargar');
        var d = $('#field_tramitacion_postventa_validar');
        var e = $('#field_tramitacion_postventa_citar');
        var f = $('#field_tramitacion_postventa_intalar');
        
        b.val(2);
        c.val(2);
        d.val(2);
        e.val(2);
        f.val(2);        
    });
    $('#field_tramitacion_venta_validar').on('change', function (event) {
        var a = $('#field_aprobado_supervisor');
        var b = $(this);
        var c = $('#field_tramitacion_venta_cargar');
        var d = $('#field_tramitacion_postventa_validar');
        var e = $('#field_tramitacion_postventa_citar');
        var f = $('#field_tramitacion_postventa_intalar');

        a.val(1);
        c.val(2);
        d.val(2);
        e.val(2);
        f.val(2);
    });
    $('#field_tramitacion_venta_cargar').on('change', function (event) {
        var a = $('#field_aprobado_supervisor');
        var b = $('#field_tramitacion_venta_validar');
        var c = $(this);
        var d = $('#field_tramitacion_postventa_validar');
        var e = $('#field_tramitacion_postventa_citar');
        var f = $('#field_tramitacion_postventa_intalar');

        a.val(1);
        b.val(1);
        d.val(2);
        e.val(2);
        f.val(2);
    });
    $('#field_tramitacion_postventa_validar').on('change', function (event) {
        var a = $('#field_aprobado_supervisor');
        var b = $('#field_tramitacion_venta_validar');
        var c = $('#field_tramitacion_venta_cargar');
        var d = $(this);
        var e = $('#field_tramitacion_postventa_citar');
        var f = $('#field_tramitacion_postventa_intalar');

        a.val(1);
        b.val(1);
        c.val(1);
        e.val(2);
        f.val(2);
        
    });
    $('#field_tramitacion_postventa_citar').on('change', function (event) {
        var a = $('#field_aprobado_supervisor');
        var b = $('#field_tramitacion_venta_validar');
        var c = $('#field_tramitacion_venta_cargar');
        var d = $('#field_tramitacion_postventa_validar');
        var e = $(this);
        var f = $('#field_tramitacion_postventa_intalar');

        a.val(1);
        b.val(1);
        c.val(1);
        d.val(1);
        f.val(2);

    });
    $('#field_tramitacion_postventa_intalar').on('change', function (event) {
        var a = $('#field_aprobado_supervisor');
        var b = $('#field_tramitacion_venta_validar');
        var c = $('#field_tramitacion_venta_cargar');
        var d = $('#field_tramitacion_postventa_validar');
        var e = $('#field_tramitacion_postventa_citar');
        var f = $(this);

        a.val(1);
        b.val(1);
        c.val(1);
        d.val(1);
        e.val(1);
    });

    $('.is_number').keydown(function (e) {
        if (
            $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1
                || (e.keyCode == 65 && e.ctrlKey === true)
                || (e.keyCode == 86 && e.ctrlKey === true)
                || (e.keyCode == 67 && e.ctrlKey === true)
                || (e.keyCode >= 35 && e.keyCode <= 39))
        {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }        
    });
    // $('.is_number').keyup(function (e) {
    //     var obj = $(this);
    //     if ( obj.val().length == 0) {
    //
    //         var myVar = setInterval( function(){
    //             if ( obj.val().length == 0) {
    //                 obj.val('1');
    //             }
    //             clearInterval(myVar);
	//     }, 1000);
    //
    //     }
    // });
    // ---------------------------------------------------------- FUNCIONES
    function venta_item_autocomplete(item) {
        var my_url = './procesos/ajax/autocomplete/ventas_listado_view_autocomplete.php?';
        my_url += 'campo=' + item.attr('campo')+ '&';
        my_url += 'dependencia=' + item.attr('dependencia')+'&';
        my_url += 'dependencia_value=' + $('#field_'+item.attr('dependencia')).val()+'&';
        my_url += 'diccionario=' + item.attr('diccionario');
        // c(my_url);
        item.autocomplete({
            source: my_url,
            minLength: 0,
            search: function( event, ui ) {
                item.removeClass('active');
                item.prev().val('0');
            },
            select: function( event, ui ) {            
                item.val(ui.item.label).addClass('active');
                item.prev().val(ui.item.id);
                return false;
            }
        });
    }
    function venta_item_div(item) {
        $('.venta-listado-view').hide();
        $('#venta-listado-view-' + item.attr('pestania')).show();
    }
    function venta_item_zclip(item) {
        var obj = item.find("label").eq(0).html();

        item.zclip({
            path: '../../lib/vendor/zclip/ZeroClipboard.swf',
            copy: obj,
            afterCopy: function() {
                console.log(obj);
                // alert('Dane w schowku. Możesz je teraz wklejać...');
            }
        });
    }

});
