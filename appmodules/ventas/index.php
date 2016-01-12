<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Ventas', '../autentificacion/index.php');


// print_r($_SESSION);



require 'vista/listado_1.tpl.php';
