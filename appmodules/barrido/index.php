<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Barrido', '../autentificacion/index.php');

// print_r($_SESSION);

require 'modelo/ModeloBarrido.php';

require 'vista/listado.tpl.php';
