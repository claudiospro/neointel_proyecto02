<?php
include "../../../lib/mysql/dbconnector.php";
include "../../../lib/mysql/conexion01.php";
include "../../../lib/mysql/utilidades.php";
include "../modelo/ModeloImportado.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = new ModeloImportado();

    $in['campania'] = Utilidades::clear_input($_POST["campania"]);
    $in['csv'] = $_FILES['myfile'];

    $csv = $modelo->read_csv($in);


     Utilidades::dump($csv);
}
//header('Location: ../../importado');

