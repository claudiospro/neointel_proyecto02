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

    function read_csv($in)
    {
      $out = [];
      $file = fopen($in['csv']['tmp_name'], 'r');

      $header = $line = fgetcsv($file, 0, $in['delimiter']);
      $out['header'] = $header;
//      Utilidades::dump($header);

      while (($row = fgetcsv($file, 0, $in['delimiter'])) !== FALSE) {
        $out['body'][] = array_combine($header, $row);
      }
//      Utilidades::dump($out);
      fclose($file);

      return $out;
    }

    function validateHeaders($campos, $header_csv)
    {
      $header_ideal = [
        'supervisor_id',
        'asesor_venta_id',
      ];
      foreach ($campos as $campo) {
        $header_ideal[] = $campo['nombre'];
      }

      $diff = array_diff($header_ideal, $header_csv);

      if (count($diff) > 0) {
        $html = '<table><tr>';
        foreach ($diff as $row) {
          $html .= sprintf("<td>%s</td>",$row);
        }
        $html .= '</tr></table>';
        return [
          'status' => false,
          'msg' => $html,
        ];
      }
      else {
        return [
          'status' => true,
        ];
      }
    }

    function validateBody($campos, $body)
    {
      $head = [];
//      $header_ideal = [
//        'supervisor_id',
//        'asesor_venta_id',
//      ];
      foreach ($campos as $campo) {
        $head[$campo['nombre'] ] = [
          'diccionario' => $campo['diccionario'],
          'tipo' => $campo['tipo'],

        ];
      }

      Utilidades::dump($head);
      Utilidades::dump($body);

    }
}
