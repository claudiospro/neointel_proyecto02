<?php
$title = 'Base Inicio';
$prefix = 'base_inicio';
?>

<?php ob_start() ?>
<?php $css = ob_get_clean() ?>


<?php ob_start() ?>
<?php $js = ob_get_clean() ?>


<?php ob_start() ?>
<?php include '../autentificacion/vista/url.php' ?>
<?php include '../autentificacion/vista/menu.tpl.php' ?>
<?php include './vista/menu.tpl.php' ?>
<?php $content = ob_get_clean() ?>


<?php include '../autentificacion/vista/layout.tpl.php' ?>
