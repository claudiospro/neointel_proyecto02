<?php 
require_once '../autentificacion/modelo/logica.php';
ModeloAuten::user_log('Importado', '../autentificacion/index.php');

include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/conexion01.php";
include "../../lib/mysql/utilidades.php";
include "../ventas/modelo/ModeloVenta.php";
include 'modelo/ModeloImportado.php';


$modeloVenta = new ModeloVenta();

$in['campanias'] = $modeloVenta->getCampaniaActivas($in);

require 'vista/listado.tpl.php';
