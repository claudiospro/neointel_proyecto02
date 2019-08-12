<?php

class datatables_libs
{
  protected $modelo;
  protected $conn;
  protected $campania;
  protected $columnas_previas = 2;

  public function __construct($in)
  {
    $this->modelo = new ModeloVenta();


    $cnn= new DBConnector_Alternative();
    $this->conn = mysqli_connect(
      $cnn->servername,
      $cnn->username,
      $cnn->password,
      $cnn->dbname
    ) or die("Connection failed: " . mysqli_connect_error());

    $this->campania = $in['campania'];
  }

  public function sql()
  {

    $campos = $this->modelo->getCampos(['campania' => $this->campania], true); // Utilidades::dump($campos);

    $sql_campos = '';
    $sql_campos_d = '';
    $sql_join = '';
    $sql_join .= ' LEFT JOIN usu_usuario u1 ON  u1.id =  v.info_create_user';
    $sql_join .= ' LEFT JOIN usu_usuario u2 ON  u2.id =  v.supervisor_id';

    $sql_campos .= 'u1.nombre_corto asesor, u2.nombre_corto supervisor, ';

    $sql_filter_01 = '';
    foreach ($campos as $i => $campo) {
      $i += $this->columnas_previas;
      if ($campo['diccionario'] != 0) {
        $sql_join .= " LEFT JOIN venta_{$campo['nombre']} f{$i} ON  f{$i}.id = d.{$campo['nombre']} ";
        $sql_campos .= "f{$i}.nombre AS field_{$i}, ";
        $sql_campos_d .= "f{$i}.id AS dicc_{$i}, ";

      } else {
        $sql_campos .= "d.{$campo['nombre']} AS field_{$i}, ";
      }

      if($campo['declarativo_fecha'] == '1') {
        $sql_filter_01 = "d.{$campo['nombre']} AS declarativo_fecha, ";
      }
    }

    $sql_campos .= $sql_campos_d;
    $sql_campos .= 'v.id, v.info_status status, ';
    $sql_campos .= $sql_filter_01;
    $sql_campos = substr($sql_campos, 0, -2);


    $sql = "SELECT $sql_campos \n";
    $sql.= "FROM venta v \n";
    $sql.= "JOIN venta_{$this->campania} d ON d.id=v.id \n";
    $sql.= " $sql_join \n";
    if ($_SESSION['perfiles_id'] == 5) {
      $sql .= "WHERE  v.info_create_user={$_SESSION['user_id']} AND v.info_status = 1";
    }
    else {
      $sql.= 'WHERE v.lineal_id IN (' . $_SESSION['lineas'] . ')';
    }
    $sql.= "";
//    Utilidades::dump($_SESSION);
//    Utilidades::dump($sql);

    $sql = "SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (\n{$sql}\n) unido, (SELECT @rownum:=0) R WHERE 1=1";

//    Utilidades::dump($sql);

    return $sql;
  }

  public function sql_filter($sql, $requestData)
  {
    $campos = $this->modelo->getCampos(['campania' => $this->campania], true); // Utilidades::dump($campos);
    $sql_filter = '';

    $i = -1;

    $value = $requestData['columns'][++$i]['search']['value'];
    if( !empty($value) ) {
      $value_clear = Utilidades::sanear_complete_string($value);
      $sql_filter.=" AND supervisor LIKE '%{$value_clear}%'";
    }
    $value = $requestData['columns'][++$i]['search']['value'];
    if( !empty($value) ) {
      $value_clear = Utilidades::sanear_complete_string($value);
      $sql_filter.=" AND asesor LIKE '%{$value_clear}%'";
    }

    foreach ($campos as $i => $campo) {
      $i += $this->columnas_previas;

      $value = $requestData['columns'][$i]['search']['value'];
      $value_clear = Utilidades::sanear_complete_string($value);
      if( !empty($value) ) {
        if ($campo['diccionario'] == 2) {
          $sql_filter.=" AND dicc_{$i} = '{$value_clear}'";
        } else {
          $sql_filter.=" AND field_{$i} LIKE '%{$value_clear}%'";
        }

      }
    }



    $sql .= $sql_filter;
//    Utilidades::dump($sql);
    return $sql;
  }

  public function count($sql, $msg)
  {
//    Utilidades::dump($sql);
    $query=mysqli_query($this->conn, $sql) or die("error count {$msg}");
    return mysqli_num_rows($query);
  }

  public function data($sql, $requestData)
  {
    $col = (intval($requestData['order'][0]['column']) + 1 );
    $dir = $requestData['order'][0]['dir'];
    $start = $requestData['start'];
    $lenght = $requestData['length'];

    $sql.=" ORDER BY $col $dir LIMIT $start, $lenght";
//    Utilidades::dump($sql);

    $query=mysqli_query($this->conn, $sql) or die("error data");
    $campos = $this->modelo->getCampos(['campania' => $this->campania], true); // Utilidades::dump($campos);

    $data = array();

    while( $row = mysqli_fetch_array($query) ) {
//      Utilidades::dump($row);
      $r = [];

      $r[] = $row['supervisor'];
      $r[] = $row['asesor'];
      foreach ($campos as $i => $campo) {
        $i += $this->columnas_previas;
        $v = $row["field_{$i}"];
        if ($campo['tipo'] == 'TIMESTAMP') {
          $r[] = substr($v, 0, 10);
        }
        elseif ($campo['tipo'] == 'TEXT') {
          $r[] = "<a style='color: black' title='{$v}'>" . substr($v, 0, 50) . "</a>";
        }
        elseif ($campo['diccionario'] != '0') {
          $fk = $row["dicc_{$i}"];
          $r[] = "<span class='{$campo['nombre']} id_{$fk}'>{$v}</span>";
        }
        else {
          $r[] = $v;
        }

      }


      $r[] = $this->acciones($row);

      $data[] = $r;

    }
//    Utilidades::dump($data);

    return $data;
  }

  public function header_excel()
  {
    $out = [];
    $campos = $this->modelo->getCampos(['campania' => $this->campania], true); // Utilidades::dump($campos);

    $out[] = 'SUPERVISOR';
    $out[] = 'ASESOR';
    foreach($campos as $campo) {
      $out[] = $campo['listado_label'];
    }

//    Utilidades::dump($campos);

    return $out;
  }

  public function header_width_excel()
  {
    $out = [];
    $campos = $this->modelo->getCampos(['campania' => $this->campania], true); // Utilidades::dump($campos);

    $out[] = 25;
    $out[] = 25;
    foreach($campos as $campo) {
      $out[] = $campo['declarativo_columna_ancho'];
    }

//    Utilidades::dump($campos);

    return $out;
  }

  public function data_excel($sql, $in)
  {
    $sql .= " AND declarativo_fecha >= '{$in['ini']}'";
    $sql .= " AND declarativo_fecha <= '{$in['end']}'";

//    echo ($sql);

    $query=mysqli_query($this->conn, $sql) or die("error data");
    $campos = $this->modelo->getCampos(['campania' => $this->campania], true); // Utilidades::dump($campos);

    $data = array();

    while( $row = mysqli_fetch_array($query) ) {
      $r = [];
      $r[] = $row['supervisor'];
      $r[] = $row['asesor'];
      foreach ($campos as $i => $campo) {
        $i += $this->columnas_previas;
        $v = $row["field_{$i}"];
        if ($campo['tipo'] == 'TIMESTAMP') {
          $r[] = substr($v, 0, 10);
        }
        else {
          $r[] = $v;
        }
      }

      $data[] = $r;
    }

    return $data;
  }

  protected function acciones($row)
  {
    $out = '';


    $out .= '<a class="button tiny view no-margin secondary" venta_id="' . $row['id'] . '" campania="' . $this->campania . '" data-open="venta_listado_modal_div" title="Ver" ><i class="fi-info medium"></i></a>';
    if ($_SESSION['perfiles_id'] != 5) {
      $out .= '<a class="button tiny edit no-margin" venta_id="' . $row['id'] . '" campania="' . $this->campania . '" data-open="venta_listado_modal_div" title="Editar" ><i class="fi-pencil medium"></i></a>';
      if ($row['status'] == 1) {
        $out .= '<a class="button tiny delete no-margin alert" venta_id="' . $row['id'] . '" campania="' . $this->campania . '" title="Eliminar" ><i class="fi-x medium"></i></a>';
      } else {
        $out .= '<a class="button tiny delete no-margin alert" venta_id="' . $row['id'] . '" campania="' . $this->campania . '" title="Restaurar" ><i class="fi-page-doc medium" style="padding: 0 1px 0 0;"></i></a>';
      }

    }
    return "<div style='text-align: center;'>{$out}</div>";
  }

}