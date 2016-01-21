function a(input) {
    alert(input);
}
function c(input) {
    console.log(input);
}
function none_simple(path, enviar) {
    $.ajax({
	type: "POST",
	data: enviar,
	url: path,
	success: function(data) {}
    });
}
function flag_simple(path, enviar, compare) {
    $.ajax({
	type: "POST",
	data: enviar,
	url: path,
	success: function(data) {
            alert(compare[data]);
        }
    });
}
function select_simple(path, componente, enviar) {
    var select = $(componente);	
    $.ajax({
	type: "POST",
	data: enviar,
	url: path,
	success: function(data) {
	    select.html(data);
	    select.trigger('chosen:updated');
	}
    });
}
function element_simple(path, componente, enviar) {
    $.ajax({
	type: "POST",
	data: enviar,
	url: path,
	success: function(data) {
	    $(componente).html(data);
	}
    });
}
function delete_simple(path, componente, enviar) {
    componente.css( 'background-color', '#FEC7C7' );
    $.ajax({
	type: "POST",
	url: path,
	data: enviar,
	success: function( data ) {
	    if (data.trim() =='SIN PERMISO') {
		componente.css( 'background-color', 'transparent' );
		alert( data.trim() );		    
	    } else {
		var myVar = setInterval( function() {
		    componente.remove();
                    clearInterval(myVar);
		}, 2100 );
	    }
	}
    });
}
function tr_td_simple(path, componente, enviar) {
    $.ajax({
	type: "POST",
	data: enviar,
	url: path,
	success: function(data) {
            if (enviar.id=='0') {
                $(componente + ' tbody').append(data);
            } else {
                $(componente+' tbody .item_' + enviar.id).html(data);
            }
	}
    });
}
function tr_td_simple_add(path, componente, enviar) {
    $.ajax({
	type: "POST",
	data: enviar,
	url: path,
	success: function(data) {
            $(componente + ' tbody').append(data);
	}
    });
}
