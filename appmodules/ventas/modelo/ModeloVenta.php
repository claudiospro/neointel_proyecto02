<?php 
class ModeloVenta {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getCampos($in) {
        $this->q->fields = array(
            'grupo' => '',
            'grupo_etiqueta' => '',
            'nombre' => '',
            'etiqueta' => '',
            'tabla' => '',
            'diccionario' => '',
            'dependencia' => '',
            'diccionario_nombre' => '',
            'tipo' => '',
            'perfiles' => '',
            'permisos' => ''
        );
        $this->q->sql = '
        SELECT
          grupo
        , grupo_etiqueta
        , nombre
        , etiqueta
        , tabla
        , diccionario
        , diccionario_dependencia
        , diccionario_nombre
        , tipo
        , perfiles
        , permisos
        FROM venta_' . $in['campania'] . '_campos
        ORDER BY orden
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getUnDato($in) {
        $this->q->fields = $in['fields'];
        $this->q->sql = '
        SELECT * FROM venta_' . $in['campania'] . '
        WHERE id="' . $in['venta_id'] . '"
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }
    function imprimirCampo($dato, $campo, $campania) {
        $ou = $dato;
        $perfiles = explode(', ', trim($campo['perfiles']));
        $permisos = explode(', ', trim($campo['permisos']));
        $permiso = $permisos[array_search($_SESSION['perfiles_id'], $perfiles)];
        if ($permiso == 'w') {
            if ($campo['diccionario']=='0' && $campo['tipo']=='VARCHAR') {
                $ou = '<input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" value="' . $ou . '" class="no-margin">';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP') {
                $ou = '<div class="input-group datapicker-simple no-margin">
                          <input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" class="no-margin" value="' . substr($ou, 0, 10) . '" readonly>
                          <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
                       </div>
                      ';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP-VARCHAR') {
                $ou = '<div class="input-group no-margin">
                          <input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" class="no-margin" value="' . $ou . '" >
                          <i class="input-group-label fi-calendar size-24"></i>
                         </div>
                        ';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TEXT') {
                $ou = '<textarea name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin" rows="2">' . $ou . '</textarea>
                        ';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TELEFONO') {
                $error = '';
                if (strlen($ou)!=9) $error = 'error';
                $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="text" 
                              value="' . $ou . '" 
                              maxlength="9"
                              class="no-margin venta_item_telefono ' . $error . '">';
            } elseif ($campo['diccionario']=='1') {
                if ($dato == '') {
                    $ou = '<input name="' . $campo['nombre'] . '"
                                  id="field_' . $campo['nombre'] . '"
                                  type="hidden"
                                  value="0">
                           <input name="' . $campo['nombre'] . '_value"
                                  id="field_' . $campo['nombre'] . '_value"
                                  type="text" 
                                  class="venta_item_autocomplete autocomplete no-margin" 
                                  campo="' . $campo['nombre'] . '" 
                                  dependencia="' . $campo['dependencia'] . '"
                                  value="">';
                } else {
                    $this->q->fields = array('nombre' => '');
                    if ($campo['diccionario_nombre'] == '')
                        $this->q->sql = 'SELECT nombre FROM venta_' . $campo['nombre'] . ' WHERE id="' . $dato . '"';
                    else
                        $this->q->sql = 'SELECT nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE id="' . $dato . '"';
                    // echo $this->q->sql;        
                    $this->q->data = NULL;
                    $data = $this->q->exe();
                    $data = $data[0]['nombre'];
                    $ou = '<input name="' . $campo['nombre'] . '"
                                  id="field_' . $campo['nombre'] . '"
                                  type="hidden"
                                  value="' . $dato . '">
                           <input name="' . $campo['nombre'] . '_value" 
                                  id="field_' . $campo['nombre'] . '_value"
                                  type="text"
                                  class="venta_item_autocomplete autocomplete no-margin active"
                                  campo="' . $campo['nombre'] . '"
                                  dependencia="' . $campo['dependencia'] . '"
                                  diccionario="' . $campo['diccionario_nombre'] . '"
                                  value="' . utf8_encode($data) . '">';
                }

            } elseif ($campo['diccionario']=='2') {
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin">';
                $ou.= '<option value="0"></option>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 ORDER BY 2';
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 ORDER BY 2';
                //echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                foreach ($data as $row) {
                    if ($row['id'] != $dato) {
                        $ou.= '<option value="' . $row['id'] . '">' . utf8_encode($row['nombre']) . '</option>';
                    } else {
                        $ou.= '<option value="' . $row['id'] . '" selected>' . utf8_encode($row['nombre']) . '</option>';
                    }
                    
                }
                $ou.= '</select>';
            } elseif ($campo['diccionario']=='3') {
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin">';
                $this->q->fields = array('id' => '', 'nombre' => '');
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 and campania="' . $campania . '" ORDER BY 2';
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 and campania="' . $campania . '" ORDER BY 2';
                // echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                foreach ($data as $row) {
                    if ($row['id'] != $dato) {
                        $ou.= '<option value="' . $row['id'] . '">' . utf8_encode($row['nombre']) . '</option>';
                    } else {
                        $ou.= '<option value="' . $row['id'] . '" selected>' . utf8_encode($row['nombre']) . '</option>';
                    }
                    
                }
                $ou.= '</select>';
            } else {
                $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="text" 
                              value="' . $ou . '" 
                              class="no-margin" 
                              style="color:red">';
            }
        } elseif ($permiso == 'r') {
            if ($campo['diccionario']!='0') {
                $this->q->fields = array('nombre' => '');
                $this->q->sql = '
                SELECT nombre FROM venta_' . $campo['nombre'] . '
                WHERE id="' . $dato . '"
                ';
                $this->q->data = NULL;
                $ou = $this->q->exe();
                $ou = $ou[0]['nombre'];
            }
            if ('TIMESTAMP' == strtoupper($campo['tipo'])) {
                $ou = substr($ou, 0, 10);
            } else {
                $ou = utf8_encode($ou);
            }            
        }
        return $ou;
    }
    function sqlCampo($dato, $campo, $tipo) {
        $ou = '';
        $perfiles = explode(', ', trim($campo['perfiles']));
        $permisos = explode(', ', trim($campo['permisos']));
        $permiso = $permisos[array_search($_SESSION['perfiles_id'], $perfiles)];        
        
        if ($permiso == 'w') {
            if ($campo['diccionario'] == '1') {
                if ($dato['id'] == '0' && '' != trim($dato['value'])) {
                    $table = $campo['nombre'];
                    if ($campo['diccionario_nombre'] != '') {
                        $table = $campo['diccionario_nombre'];
                    }
                    $this->q->fields = array('id' => '');
                    $this->q->sql = 'SELECT id FROM venta_' . $table . ' WHERE nombre="' . $dato['value'] . '"';
                    // echo $this->q->sql;        
                    $this->q->data = NULL;
                    $data = $this->q->exe();
                    if (is_array($data)) {
                        $dato = $data[0]['id'];
                    } else {
                        $dep_campo = '';
                        $dep_value = '';
                        if ($dato['dependencia'] !='') {
                            $dep_campo = ', '. $dato['dependencia'];
                            $dep_value = ', '. $dato['dependencia_value'];
                        } 
                        $this->q->fields = array();
                        $this->q->sql = 'INSERT INTO venta_' . $table . ' (nombre' . $dep_campo . ') VALUES ("' . utf8_encode($dato['value']) . '"' . $dep_value . ')';
                        $this->q->data = NULL;
                        $this->q->exe();
                        // capturando
                        $this->q->fields = array('id' => '');
                        $this->q->sql = 'SELECT id FROM venta_' . $table . ' WHERE nombre="' . $dato['value'] . '"';
                        $this->q->data = NULL;
                        $data = $this->q->exe();
                        $dato = $data[0]['id'];
                    }
                } elseif ($dato['id'] == '0' && '' == trim($dato['value'])) {
                    $dato = '0';
                } else {
                    $dato = $dato['id'];
                }
            }
            if ($tipo == 'insert') {
                $ou['campos'] = $campo['nombre'];
                $ou['valores'] = '"' . $dato . '"';
            } elseif($tipo == 'update') {
                $ou = $campo['nombre'] . '="' . $dato . '"';
            }
        }
        return $ou;            
    }
    function setVenta($in) {
        $this->q->fields = array(
            'id' => ''
        );
        $this->q->sql = '
        CALL ventas_save(
          "' . $in['venta_id'] . '"
        , "' . $in['campania'] . '"
        , "' . $in['fecha'] . '"
        , "' . $in['usuario'] . '"
        )
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['id'];
    }
    function setVentaCampania($sql) {
        $this->q->fields = array();
        $this->q->sql = $sql;
        $this->q->data = NULL;
        $this->q->exe();
    }
    //
    function getCampaniaActivas() {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT indice, nombre FROM campania
        WHERE info_status = 1
        ORDER BY 2
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    //
    function getAutoComplete($in) {
        $this->q->fields = array(
            'termino' => '', 'id' => ''
        );
        $dependencia = '';
        if ($in['dependencia'] !='') {            
            $dependencia = ' AND ' . $in['dependencia'] .'="' . $in['dependencia_value'] . '"';
        }
        $tabla = $in['campo'];
        if ($in['diccionario'] != '')
            $tabla = $in['diccionario'];
        
        $this->q->sql = '
        SELECT nombre, id FROM venta_' . $tabla . '
        WHERE info_status = 1 AND nombre LIKE "%' . $in['termino'] . '%"' . $dependencia . '
        ORDER BY 1
        LIMIT 15
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;        
    }
}
