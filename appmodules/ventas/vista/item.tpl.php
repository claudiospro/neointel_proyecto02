<?php
$title = 'Ventas Item';
$prefix = 'venta_item_';
?>


<?php ob_start() ?>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php print_r($_SESSION) ?>
<?php $content = ob_get_clean() ?>


<?php include '../autentificacion/vista/layout.tpl.php' ?>
