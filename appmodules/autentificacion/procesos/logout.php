<?php 
include "../../../lib/mysql/utilidades.php";
include "../modelo/logica.php";

ModeloAuten::logOut();
header('Location: ../../autentificacion/index.php');

