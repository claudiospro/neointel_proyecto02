<?php
include "../../../lib/mysql/dbconnector.php";
include "../../../lib/mysql/conexion01.php";
include "../../../lib/mysql/utilidades.php";
include "../modelo/logica.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $in['user_id'] = $_SESSION["user_id"];
    $in['login'] = $_SESSION["user_name"];
    $in['pwd-old'] = Utilidades::clear_input($_POST["pwd-old"]);
    $in['pwd-new-1'] = Utilidades::clear_input($_POST["pwd-new-1"]);
    $in['pwd-new-2'] = Utilidades::clear_input($_POST["pwd-new-2"]);
    // var_dump($in);
    ModeloAuten::changePWD($in);
    
}
header('Location: ../../autentificacion/index.php');

