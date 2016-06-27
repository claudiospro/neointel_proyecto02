<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloUsuario.php";
session_start();
$modelo = new ModeloUsuario();
// -------------------------------------------------------- INPUT
$in['usuario_id'] = Utilidades::clear_input_id($_POST['usuario_id']);
$in['dni'] = Utilidades::clear_input_id($_POST['dni']);


// -------------------------------------------------------- Data
echo $modelo->verificar_usuario($in);

// -------------------------------------------------------- TEST
// Utilidades::printr($in);
// Utilidades::printr($_SESSION);
// Utilidades::printr($dato);


