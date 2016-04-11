<?php
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Usuario', '../autentificacion/index.php');

require 'vista/listado.tpl.php';
