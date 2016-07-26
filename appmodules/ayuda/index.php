<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log_0('../autentificacion/index.php');

include "../../lib/mysql/utilidades.php";
include "./modelo/logica.php";
$logica = new LogicaAyuda();

require 'vista/principal.tpl.php';
