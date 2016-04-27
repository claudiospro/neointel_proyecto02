<?php // vista/layout.tpl.php   ?>

<!doctype html> 
<html class="no-js" lang="es">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- no cache -->

    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="../../lib/vendor/foundation-6/css/foundation.min.css" />
    <link rel="stylesheet" href="../../lib/vendor/foundation-icons/foundation-icons.css" />
    <?php if(isset($css)) echo $css ?>
    <link rel="stylesheet" href="../../lib/main/estilo.css?v=1.2.5" />
    
  </head>
  <body>
    <?php echo $content ?>
    <script src="../../lib/vendor/foundation-6/js/vendor/jquery.min.js"></script>
    <script src="../../lib/vendor/foundation-6/js/foundation.min.js"></script>
    <script src="../../lib/vendor/foundation-6/js/app.js"></script>
    <script src="../../lib/main/reutilizables.js "></script>
    <?php if(isset($js)) echo $js ?>
  </body>
</html>
