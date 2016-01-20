<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Ventas', '../autentificacion/index.php');

require 'vista/item.tpl.php';