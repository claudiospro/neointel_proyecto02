<?php $title = 'List of Posts' ?>

<?php ob_start() ?>
<?php include 'menu.tpl.php' ?>
<div class="row"> 
  <div class="large-12 column">
    <hr>
    <div class="callout success">
      <h1>Usuario: <?php echo $_SESSION['user_name'] ?></h1>
    </div>
    <hr>
  </div>
</div>

<?php $content = ob_get_clean() ?>

<?php include 'layout.tpl.php' ?>
