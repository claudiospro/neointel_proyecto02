<?php
$title = 'Ventas Item';
$prefix = 'venta_item_';
?>


<?php ob_start() ?>
<link rel="stylesheet" href="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/css/dataTables.foundation.min.css">
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<script src="../../lib/vendor/datatable-1.10.10/datatables.min.js"></script>
<script src="../../lib/vendor/datatable-1.10.10/DataTables-1.10.10/js/dataTables.foundation.min.js"></script>

<script src="../../lib/vendor/jquery.jeditable/jquery.jeditable.mini.js"></script>
<script>
 $(document).ready(function() {
     var oTable = $('#example').dataTable( {
         "bProcessing": true,
         "bServerSide": true,
         "sAjaxSource": "test/data.php",
         "fnDrawCallback": function () {
             $('#example tbody td').editable( './test/edit.php', {

                 "callback": function( sValue, y ) {
                     /* Redraw the table from the new data on the server */
                     oTable.fnDraw();
                 },
                 "height": "14px",
             } );
         }
     } );
     $('.edit1').editable('./test/edit.php');
     $('.edit2').editable('./test/edit.php', {
         indicator : 'Saving...',
         tooltip   : 'Click to edit...'
     });
     $('.edit3').editable('./test/edit.php', {
         type      : 'textarea',
         cancel    : 'Cancel',
         submit    : 'OK',
         indicator : '<img src="./test/indicator.gif">',
         tooltip   : 'Click to edit...'
     });
     $('.edit4').editable('./test/edit.php', {
         id   : 'campo',
         name : 'valor',
         cssclass : 'someclass',
     });
     $('.edit5').editable('./test/edit.php', {
         data   : " {'E':'Letter E','F':'Letter F','G':'Letter G', 'selected':'F'}",
         type   : 'select',
         submit : 'OK'
     });
     $('.edit6').editable('./test/edit.php', {
         loadurl : './test/select.php',
         type   : 'select',
         submit : 'OK'
     });
 } );
</script>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<div class="edit1" id="div_1">Test</div>
<div class="edit2" id="div_2">Dolor</div>
<div class="edit3" id="div_3">Lorem ipsum dolor sit amet, consectetuer
  adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
  magna aliquam erat volutpat.
</div>
<hr>
<div class="edit4" id="div_4">Exacto</div>
<div class="edit5" id="div_5">Letter F</div>
<div class="edit6" id="div_6">Letter G</div>

<hr>
<table id="example">
  <thead>
    <tr>
      <th>a</th>
      <th>b</th>
      <th>c</th>
      <th>d</th>
      <th>e</th>     
    </tr>
  </thead>
</table>

<?php $content = ob_get_clean() ?>


<?php include '../autentificacion/vista/layout.tpl.php' ?>
