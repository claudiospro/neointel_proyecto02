<?php 
class ModeloImportado {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getEstados() {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado WHERE info_status= 1 
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }

    function read_csv($in) {
      $out = [];
      $file = fopen($in['csv']['tmp_name'], 'r');

      $header = $line = fgetcsv($file);
//      Utilidades::dump($header);

      while (($row = fgetcsv($file)) !== FALSE) {
        $out[] = array_combine($header, $row);
      }
//      Utilidades::dump($out);
      fclose($file);

      return $out;
    }
}
