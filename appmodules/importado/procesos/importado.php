<style>
  table {
    border-collapse: collapse;
  }

  table, th, td {
    border: 1px solid red;
    background-color: #ffcfcf;
    padding: 1em;
    color:red;
  }
</style>
<?php
include "../../../lib/mysql/dbconnector.php";
include "../../../lib/mysql/conexion01.php";
include "../../../lib/mysql/utilidades.php";
include "../modelo/ModeloImportado.php";
include "../../ventas/modelo/ModeloVenta.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $modelo = new ModeloImportado();
  $modeloVenta = new ModeloVenta();

  $in['campania'] = Utilidades::clear_input($_POST["campania"]);
  $in['csv'] = $_FILES['myfile'];
  $in['delimiter'] = $_POST["delimiter"];

  $campos = $modeloVenta->getCampos($in, False); // Utilidades::dump($campos);

  $csv = $modelo->read_csv($in);  // Utilidades::dump($csv);

  $validateHeaders = $modelo->validateHeaders($campos, $csv['header']);
  if (! $validateHeaders['status']) {
    echo '<script>alert("Falta los siguientes encabezados");</script>';
    echo $validateHeaders['msg'];
    die();
  }

  $validateBody = $modelo->validateBody($campos, $csv['body']);
  // optener encabezados
  // compoarar e


}
//header('Location: ../../importado');

