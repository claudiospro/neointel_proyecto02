<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Apuntes', '../autentificacion/index.php');

// print_r($_SESSION);

require 'vista/listado.tpl.php';
