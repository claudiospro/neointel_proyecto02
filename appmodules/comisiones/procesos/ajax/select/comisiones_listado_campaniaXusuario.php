<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/tabla.php";
include "../../../modelo/ModeloComision.php";

session_start();
$modelo = new ModeloComision();

// -------------------------------------------------------- INPUT
$in['campania_id'] = Utilidades::clear_input_id($_POST['campania_id']);
$in['lineas'] = trim($_SESSION['lineas']);

// -------------------------------------------------------- Data
$ou = $modelo->campaniasXusuario($in);
$combo = new OptionComboSimple();
$combo->set_option($in['campania_id']);
$combo->set_format(array('id', 'nombre'));
$combo->imprimir($ou);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($ou);

// -------------------------------------------------------- OUT
// echo '<option>aqui</option>';