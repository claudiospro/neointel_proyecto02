$(document).ready(function() {
 $('#declarativo_field_export').on('click', function (event) {
    var out  = declarativo_field_export($(this));


    if (out == false) {
        event.preventDefault();
    }
 });
 function declarativo_field_export(item) {
     var out = true;
     var enviar = {
         'ini1'     : $('#declarativo_field_ini').val(),
         'end1'     : $('#declarativo_field_end').val(),
         'ini2'    : '',
         'end2'    : '',
         'campania': $('#declarativo_field_campanias').val(),
     }
     // c(enviar);


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
         enlace = 'procesos/ajax/click/ventas_listado_declarativo_excel.php?';
         enlace+= 'ini=' + enviar.ini1 + '&';
         enlace+= 'end=' + enviar.end1 + '&';
         enlace+= 'campania=' + enviar.campania;
         item.attr('href', enlace);

     } else {
         a('La Fecha INICIO no puede ser MAYOR a la de FIN');
         out = false;
     }

     return out;
 }    
});
