<?php
$title = 'Ventas Listado';
$prefix = 'venta_listado_';
?>

<?php ob_start() ?>
<!-- <link rel="stylesheet" href="../../lib/vendor/"> -->

<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<!-- <script src="../../lib/vendor/"></script> -->
<!-- <script src="../../static/apuntes/"></script> -->
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>

<?php
include '../autentificacion/vista/url.php';
include '../autentificacion/vista/menu.tpl.php';
// print_r($_SESSION);
?>


<?php $content = ob_get_clean() ?>

<?php include '../autentificacion/vista/layout.tpl.php' ?>
