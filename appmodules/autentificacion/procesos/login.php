<?php
include "../../../lib/mysql/dbconnector.php";
include "../../../lib/mysql/conexion01.php";
include "../../../lib/mysql/utilidades.php";
include "../modelo/logica.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $in['nombre'] = Utilidades::clear_input($_POST["nombre"]);
    $in['pwd'] = Utilidades::clear_input($_POST["pwd"]);
    ModeloAuten::logIn($in);
    var_dump($_SESSION);
}
header('Location: ../../autentificacion/index.php');

