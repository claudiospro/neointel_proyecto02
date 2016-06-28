$(document).ready(function() {
 $('#declarativo_field_export_3').on('click', function (event) {
     venta_listado_report_3($(this));
 });
 function venta_listado_report_3(item) {
     var enviar = {
         'ini1': $('#declarativo_field_ini_3').val(),
         'ini2': '',
         'end1': $('#declarativo_field_end_3').val(),
         'end2': '',
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
         enlace = 'procesos/ajax/click/ventas_listado_declarativo_excel_campania_03.php?';
         enlace+= 'ini=' + enviar.ini1 + '&';
         enlace+= 'end=' + enviar.end1;
         item.attr('href', enlace);
     } else {
         a('La Fecha INICIO no puede ser MAYOR a la de FIN');
     }
 }    
});
