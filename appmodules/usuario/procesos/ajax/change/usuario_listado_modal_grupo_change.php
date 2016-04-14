<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../modelo/ModeloUsuario.php";

$modelo = new ModeloUsuario();
session_start();

// -------------------------------------------------------- INPUT
$in['form']['estado']     = Utilidades::clear_input_bool($_POST['estado']);
$in['form']['lineal_id']   = Utilidades::clear_input_id($_POST['grupo_id']);
$in['form']['usuario_id'] = Utilidades::clear_input_id($_POST['usuario_id']);
$in['fecha'] = date('Y-m-d H:i:s');
$in['usuario'] = $_SESSION['user_id'];


// -------------------------------------------------------- Data
$modelo->updateUsuarioGrupo($in);


// -------------------------------------------------------- TEST
// Utilidades::printr($in);


// -------------------------------------------------------- OUT
