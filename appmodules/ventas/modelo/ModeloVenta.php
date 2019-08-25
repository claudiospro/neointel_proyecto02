<?php 
class ModeloVenta {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getCampos($in, $h=false) {
        $this->q->fields = array(
            'pestana' => '',
            'grupo' => '',
            'grupo_etiqueta' => '',
            'nombre' => '',
            'etiqueta' => '',
            'tabla' => '',
            'diccionario' => '',
            'dependencia' => '',
            'diccionario_nombre' => '',
            'diccionario_orden' => '',
            'tipo' => '',
            'perfiles' => '',
            'permisos' => '',
            'listado_aparece' => '',
            'listado_label' => '',
            'listado_ancho' => '',
            'listado_permisos' => '',
            'campo_mayuscula' => '',
            'campo_obligatorio' => '',
            'declarativo_fecha' => '',
            'declarativo_columna_ancho' => '',
        );

        if ($h) {
          $order = 'listado_orden';
          $where = 'WHERE listado_aparece=1';
        }
        else {
          $order = 'orden';
          $where = '';
        }

        $this->q->sql = '
        SELECT
          pestana
        , grupo
        , grupo_etiqueta
        , nombre
        , etiqueta
        , tabla
        , diccionario
        , diccionario_dependencia
        , diccionario_nombre
        , diccionario_orden
        , tipo
        , perfiles
        , permisos
        , listado_aparece
        , listado_label
        , listado_ancho
        , listado_permisos
        , campo_mayuscula
        , campo_obligatorio
        , declarativo_fecha
        , declarativo_columna_ancho
        FROM venta_' . $in['campania'] . '_campos
        ' . $where . '
        ORDER BY ' . $order . '
        ';
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getUnDato($in) {

      $this->q->fields = $in['fields'];

      if (isset( $in['f'])) {
        $this->q->sql = '
        SELECT ' . $in['f'] . ' FROM venta_' . $in['campania'] . '
        WHERE id="' . $in['venta_id'] . '"
        ';

        // print $this->q->sql;

        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
      }

    }
    function getUnDato_NombreCorto($in) {
        $this->q->fields = array('nombre'=>'');
        $this->q->sql = '
        SELECT u.nombre_corto FROM venta v 
        JOIN usu_usuario u ON u.id=v.asesor_venta_id
        WHERE v.id = "' . $in['venta_id'] . '"
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return ($data[0]['nombre']);
    }
    function imprimirCampo($dato, $campo, $campania) {
        $dato = ($dato);
        $ou = $dato;
        /*
         * DICCIONARIOS
         * 1: auto completado
         * 2: combo, con vacio, sin dependencia
         * 5: combo, sin vacio, sin dependencia
         * 3: combo, con vacio, con dependencia
         * 4: combo, sin vacio, con dependencia
         * 6: combo, con vacio, con dependencia-multiple
         * 7: combo, sin vacio, con dependencia-multiple
         */

        $required = '';
        if ($campo['campo_obligatorio'] == 1) {
            $required = ' required';
        }

        
        if ($campo['permiso'] == 'w') {
            if ($campo['diccionario']=='0' && $campo['tipo']=='VARCHAR') {
                $ou = '<input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" value="' . $ou . '" class="no-margin ' . $required . '" ' . $required . '>';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP') {
                $tmp = substr($ou, 0, 10);
                if ($tmp == '0000-00-00') $tmp = ''; 
                $ou = '<div class="input-group datapicker-simple no-margin">
                          <input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" class="no-margin ' . $required . '" value="' . $tmp . '" readonly ' . $required . '>
                          <a class="input-group-label" title="Limpiar"><i class="fi-calendar"></i></a>
                       </div>
                      ';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP-HM') {
                $tmp = substr($ou, 0, 16);
                if ($tmp == '0000-00-00 00:00') $tmp = ''; 
                $ou = '<div class="input-group datapicker-simple-hm no-margin">
                          <input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" class="no-margin ' . $required . '" value="' . $tmp . '" readonly ' . $required . '>
                          <a class="input-group-label" title="Limpiar"><i class="fi-calendar"></i></a>
                       </div>
                      ';
            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP-VARCHAR') {
                $ou = '<div class="input-group no-margin">
                          <input name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" type="text" class="no-margin ' . $required . '" value="' . $ou . '" ' . $required . '>
                          <i class="input-group-label fi-calendar"></i>
                         </div>
                        ';
            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='TEXT') {
                $ou = '<textarea name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin ' . $required . '" rows="2" ' . $required . '>' . $ou . '</textarea>
                        ';
            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='TELEFONO') {
                $error = 'error';
                if (strlen($ou)==9 || strlen($ou)==0) $error = '';
                $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="text" 
                              value="' . $ou . '" 
                              maxlength="9"
                              class="no-margin venta_item_telefono ' . $error . ' ' . $required . '" ' . $required . '>';
            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='INT') {
                $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="number" 
                              value="' . $ou . '"
                              min="1"
                              class="no-margin is_number ' . $required . '" ' . $required . '>';

            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='FLOAT') {
              $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="number" 
                              step="0.01"
                              value="' . $ou . '"
                              class="no-margin venta_item_float ' . $required . '" ' . $required . '>';

            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='BANCO24') {
              $error = 'error';
              if (strlen($ou)==24 || strlen($ou)==0) $error = '';
              $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="text" 
                              value="' . $ou . '" 
                              maxlength="24"
                              class="no-margin venta_item_banco banco24 ' . $error . ' ' . $required . '" ' . $required . '>';
            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='BANCO22') {
              $error = 'error';
              if (strlen($ou)==22 || strlen($ou)==0) $error = '';
              $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="text" 
                              value="' . $ou . '" 
                              maxlength="22"
                              class="no-margin venta_item_banco banco22 ' . $error . ' ' . $required . '" ' . $required . '>';
            }
            elseif ($campo['diccionario']=='0' && $campo['tipo']=='EMAIL') {
              $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="email" 
                              value="' . $ou . '"
                              class="no-margin ' . $required . '" ' . $required . '>';
            }
            elseif ($campo['diccionario']=='1') {
                if ($dato == '') {
                    $ou = '<input name="' . $campo['nombre'] . '"
                                  id="field_' . $campo['nombre'] . '"
                                   class=" ' . $required . '"
                                  type="hidden"
                                  value="0" ' . $required . '>
                           <input name="' . $campo['nombre'] . '_value"
                                  id="field_' . $campo['nombre'] . '_value"
                                  type="text" 
                                  class="venta_item_autocomplete autocomplete no-margin ' . $required . '"
                                  campo="' . $campo['nombre'] . '" 
                                  dependencia="' . $campo['dependencia'] . '"
                                  diccionario="' . $campo['diccionario_nombre'] . '"
                                  value="" ' . $required . '>';
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
                                  class=" ' . $required . '"
                                  type="hidden"
                                  value="' . $dato . '" ' . $required . '>
                           <input name="' . $campo['nombre'] . '_value" 
                                  id="field_' . $campo['nombre'] . '_value"
                                  type="text"
                                  class="venta_item_autocomplete autocomplete no-margin active ' . $required . '"
                                  campo="' . $campo['nombre'] . '"
                                  dependencia="' . $campo['dependencia'] . '"
                                  diccionario="' . $campo['diccionario_nombre'] . '"
                                  value="' . ($data) . '" ' . $required . '>';
                }

            } elseif ($campo['diccionario']=='2') { // sin dependencia, con estado vacio
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin ' . $required . '" ' . $required . '>';
                $ou.= '<option value="0"></option>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                $orderby = 'ORDER BY 2';
                if ($campo['diccionario_orden'] == '0') $orderby = '';
                
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 ' . $orderby;
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 ' . $orderby;
                //echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                foreach ($data as $row) {
                    if ($row['id'] != $dato) {
                        $ou.= '<option value="' . $row['id'] . '">' . ($row['nombre']) . '</option>';
                    } else {
                        $ou.= '<option value="' . $row['id'] . '" selected>' . ($row['nombre']) . '</option>';
                    }
                    
                }
                $ou.= '</select>';
            } elseif ($campo['diccionario']=='3') { // con dependencia, con estado vacio
                $orderby = 'ORDER BY 2';
                if ($campo['diccionario_orden'] == '0') $orderby = '';
                
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin ' . $required . '" ' . $required . '>';
                $ou.= '<option value="0"></option>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 and campania="' . $campania . '" ' . $orderby;
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 and campania="' . $campania . '" ' . $orderby;
                // echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                if ($data) {
                    foreach ($data as $row) {
                        if ($row['id'] != $dato) {
                            $ou.= '<option value="' . $row['id'] . '">' . ($row['nombre']) . '</option>';
                        } else {
                            $ou.= '<option value="' . $row['id'] . '" selected>' . ($row['nombre']) . '</option>';
                        }
                    }
                }
                
                $ou.= '</select>';
            } elseif ($campo['diccionario']=='4') { // con dependencia, sin elemento vacio 
                $orderby = 'ORDER BY 2';
                if ($campo['diccionario_orden'] == '0') $orderby = '';
                
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin ' . $required . '" ' . $required . '>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 and campania="' . $campania . '" ' . $orderby;
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 and campania="' . $campania . '" ' . $orderby;
                // echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                if ($data) {
                    foreach ($data as $row) {
                        if ($row['id'] != $dato) {
                            $ou.= '<option value="' . $row['id'] . '">' . ($row['nombre']) . '</option>';
                        } else {
                            $ou.= '<option value="' . $row['id'] . '" selected>' . ($row['nombre']) . '</option>';
                        }
                    }
                }
                
                $ou.= '</select>';
            } elseif ($campo['diccionario']=='5') { // sin dependencia, sin elemento vacio
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin ' . $required . '" ' . $required . '>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                $orderby = 'ORDER BY 2';
                if ($campo['diccionario_orden'] == '0') $orderby = '';
                
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 ' . $orderby;
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 ' . $orderby;
                // echo $this->q->sql . '<br>';        
                $this->q->data = NULL;
                $data = $this->q->exe();
                foreach ($data as $row) {
                    if ($row['id'] != $dato) {
                        $ou.= '<option value="' . $row['id'] . '">' . ($row['nombre']) . '</option>';
                    } else {
                        $ou.= '<option value="' . $row['id'] . '" selected>' . ($row['nombre']) . '</option>';
                    }
                    
                }
                $ou.= '</select>';
            } elseif ($campo['diccionario']=='6' or $campo['diccionario']=='7') {
                $orderby = 'ORDER BY 2';
                if ($campo['diccionario_orden'] == '0') $orderby = '';
                
                $ou = '<select name="' . $campo['nombre'] . '" id="field_' . $campo['nombre'] . '" class="no-margin ' . $required . '" ' . $required . '>';
                if ($campo['diccionario']=='6')
                    $ou.= '<option value="0"></option>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                if ($campo['diccionario_nombre'] == '')
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 and campania LIKE "%' . $campania . '%" ' . $orderby;
                else
                    $this->q->sql = 'SELECT id, nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE info_status=1 and campania LIKE "%' . $campania . '%" ' . $orderby;
                // echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                if ($data) {
                    foreach ($data as $row) {
                        if ($row['id'] != $dato) {
                            $ou.= '<option value="' . $row['id'] . '">' . ($row['nombre']) . '</option>';
                        } else {
                            $ou.= '<option value="' . $row['id'] . '" selected>' . ($row['nombre']) . '</option>';
                        }
                    }
                }
                $ou.= '</select>';
            } else {
                $ou = '<input name="' . $campo['nombre'] . '" 
                              id="field_' . $campo['nombre'] . '" 
                              type="text" 
                              value="' . $ou . '" 
                              class="no-margin ' . $required . '" 
                              style="color:red" ' . $required . '>';
            }
        } elseif ($campo['permiso'] == 'r') {
            if ($campo['diccionario']!='0') {                
                $this->q->fields = array('nombre' => '');
                if ($campo['diccionario_nombre'] == '') 
                    $this->q->sql = 'SELECT nombre FROM venta_' . $campo['nombre'] . ' WHERE id="' . $dato . '"';
                else
                    $this->q->sql = 'SELECT nombre FROM venta_' . $campo['diccionario_nombre'] . ' WHERE id="' . $dato . '"';
                // echo $this->q->sql.'<br>';                
                $this->q->data = NULL;
                $ou = $this->q->exe();
                $ou = ($ou[0]['nombre']);
            }
            if ('TIMESTAMP' == strtoupper($campo['tipo'])) {
                $ou = trim(substr($ou, 0, 10));
            } else {
                $ou = $ou;
            }
            $ou = '
                  <a class="copy-link-wrap" style="text-decoration: none; display: block; padding: 0.5em; line-height: 1em;">    
                     <label>'. ($ou).'</label>                
                  </a>
                  ';
        }
        return $ou;
    }
    function sqlCampo($dato, $campo, $tipo) {
        $ou = '';
        $perfiles = explode(', ', trim($campo['perfiles']));
        $permisos = explode(', ', trim($campo['permisos']));
        $permiso = $permisos[array_search($_SESSION['perfiles_id'], $perfiles)];
        if ($campo['nombre']=='estado' ||
            $campo['nombre']=='cliente_tipo' ||
            $campo['nombre']=='producto')
        {
            $permiso = 'w';
        }
        
        if ($permiso == 'w') {
            if ($campo['diccionario'] == '1') {
                if ($dato['id'] == '0' && '' != trim($dato['value'])) {
                    $table = $campo['nombre'];
                    if ($campo['diccionario_nombre'] != '') {
                        $table = $campo['diccionario_nombre'];
                    }
                    $this->q->fields = array('id' => '');
                    $this->q->sql = 'SELECT id FROM venta_' . $table . ' WHERE nombre="' . Utilidades::sanear_complete_string($dato['value']) . '"';
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
                        $this->q->sql = 'INSERT INTO venta_' . $table . ' (nombre' . $dep_campo . ') VALUES ("' . utf8_decode($dato['value']) . '"' . $dep_value . ')';
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

            if ($campo['campo_mayuscula'] == 1) {
                $dato = mb_strtoupper($dato);                
            } else {
                Utilidades::dump($campo);                
            }
            
            if ($tipo == 'insert') {
                $ou['campos'] = $campo['nombre'];
                $ou['valores'] = '"' . ($dato) . '"';
            } elseif($tipo == 'update') {
                $ou['sql'] = $campo['nombre'] . '="' . ($dato) . '"';                
            }
            $ou['dato'] = ($dato);
            
        }
        return $ou;            
    }
    function setVenta($in) {
        $this->q->fields = array(
            'id' => ''
        );
        $this->q->sql = '
        CALL ventas_save(
          "' . (int) $in['venta_id'] . '"
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
    function deleteVenta($in) {
        $this->q->fields = array(
            'info_status' => ''
        );
        $this->q->sql = ' 
        SELECT info_status FROM venta WHERE id="' . $in['id'] . '"
        ';
        echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe(); Utilidades::dump($data);
        
        $this->q->fields = array();
        if ($data[0]['info_status'] == '0') {
            $this->q->sql = 'UPDATE venta SET info_status="1", info_update_user="' . $in['user'] . '", info_update_fecha="' . $in['fecha'] . '" WHERE id="' . $in['id'] . '"';  
        } elseif ($data[0]['info_status'] == '1') {
            $this->q->sql = 'UPDATE venta SET info_status="0", info_update_user="' . $in['user'] . '", info_update_fecha="' . $in['fecha'] . '" WHERE id="' . $in['id'] . '"';  
        }
        $this->q->exe();
    }
    //
    function getCampaniaActivas($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
        $this->q->sql = '
        SELECT DISTINCT c.indice, c.nombre FROM campania c
        JOIN campania_lineal cl ON cl.campania_id = c.id
        WHERE c.info_status = 1 AND c.venta=1
        ';
//      Utilidades::dump( $this->q->sql);

        if ('' != trim($in['lineas'])) {
            $this->q->sql.= ' AND cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getEstadoActivas($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado WHERE info_status=1';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getEstadoRealActivas($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
//        $this->q->sql = '
//        SELECT id, nombre FROM venta_estado_real WHERE info_status=1 AND campania LIKE "%' . $in['campania'] . '%"';

        $this->q->sql = '
        SELECT id, nombre FROM venta_estado_real WHERE info_status=1';
//        echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getEstadoTramitacionActivas($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado_tramitacion WHERE info_status=1';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getEstadoTramitacionPerfilActivas($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );        
        $this->q->sql = '
        SELECT id, nombre FROM venta_estado_tramitacion WHERE id not in (' . $in['tramitacion-denegado'] . ') AND info_status=1';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    //
    function getEstadoRealToEstado($id) {
        $this->q->fields = array(
            'estado_id' => '',
        );        
        $this->q->sql = 'SELECT estado_id FROM venta_estado_real WHERE id = "' . $id . '"';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['estado_id'];
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
        if ($in['diccionario'] != '') $tabla = $in['diccionario'];        
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
    //
    function getPestaniaCampania($in) {
        $this->q->fields = array(
            'pestania' => '', 
        );
        $this->q->sql = 'SELECT DISTINCT pestana FROM venta_' . $in['campania'] . '_campos ORDER BY orden';
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;                
    }
    
    // ---------------------------- Declarativo
    // ----- version 1: eligiendo campos
    function getDeclarativo_01($in) {
        $ou = '';
        $this->q->fields = array(
            'nombre' => '',
            'etiqueta' => '',
            'grupo' => '',
            'diccionario' => '',
            'tipo' => '',
            'diccionario_nombre' => '',
            'declarativo_orden' => '',
            'declarativo_etiqueta' => '',
        );
        $this->q->sql = 'SELECT nombre, etiqueta, grupo_etiqueta, diccionario, tipo, diccionario_nombre, declarativo_orden, declarativo_etiqueta
                         FROM venta_' . $in['campania'] . '_campos
                         ORDER by orden';
        $this->q->data = NULL;
        // echo $this->q->sql .'<br>';
        $data = $this->q->exe();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $tot = count($data);
       
        $fields = array('asesor_venta_id'=> '', 'supervisor_id'=>'', 'coordinador_id'=>'', 'info_create_fecha'=>'', 'id'=>'');
        $info = array(
            'info_create_fecha' => array('diccionario'=>'0' , 'tipo'=>'TIMESTAMP-VARCHAR', 'diccionario_nombre' => '', 'nombre'=>'', 'declarativo_orden'=>'-3', 'declarativo_etiqueta' => 'FECHA'),
            'supervisor_id'     => array('diccionario'=>'0'  , 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>'', 'declarativo_orden'=>'-2', 'declarativo_etiqueta' => 'SUPERVISOR'),
            'asesor_venta_id'   => array('diccionario'=>'0', 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>'', 'declarativo_orden'=>'-1', 'declarativo_etiqueta' => 'COMERCIAL'),
            'coordinador_id'    => array('diccionario'=>'0' , 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>'', 'declarativo_orden'=>'', 'declarativo_etiqueta' => ''),
            'id'                => array('diccionario'=>'0', 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>'', 'declarativo_orden'=>'', 'declarativo_etiqueta' => '')
        );
        $orden = array('-3' => 'info_create_fecha', '-2' => 'supervisor_id', '-1' => 'asesor_venta_id');
        for ($i=0; $i<$tot; $i++) {
            $fields[$data[$i]['nombre']] = '';
            $info[$data[$i]['nombre']] = array(
                'diccionario'=> $data[$i]['diccionario'],
                'tipo'=>$data[$i]['tipo'],
                'diccionario_nombre' => $data[$i]['diccionario_nombre'],
                'nombre' => $data[$i]['nombre'],
                'declarativo_orden' => $data[$i]['declarativo_orden'],
                'declarativo_etiqueta' => $data[$i]['declarativo_etiqueta'],
            );
            if ('' != trim($data[$i]['declarativo_etiqueta'])) {
                $orden[$data[$i]['declarativo_orden']] = $data[$i]['nombre'];
            }
        }
        ksort($orden);
        
        // datos --------------------------------------------------------
        $this->q->fields = $fields;
        $this->q->sql = '
        SELECT  av.nombre, su.nombre, co.nombre, v.info_create_fecha, d.* 
        FROM venta v
        JOIN usu_usuario av ON av.id = v.asesor_venta_id 
        JOIN usu_usuario su ON su.id = v.supervisor_id
        JOIN usu_usuario co ON co.id = v.coordinador_id
        JOIN venta_' . $in['campania'] . ' d ON d.id=v.id
        WHERE v.info_status=1 ';
        if(trim($_SESSION['lineas']) != '') {
            $this->q->sql.= ' AND v.lineal_id IN (' . $_SESSION['lineas'] . ')';
        }
        if (trim($in['ini'])!='') {
            $this->q->sql.= ' AND v.info_create_fecha >= "' . $in['ini'] . ' 00:00:00"';
        }
        if (trim($in['end'])!='') {
            $this->q->sql.= ' AND v.info_create_fecha <= "' . $in['end'] . ' 23:59:59"';
        }
        // echo $this->q->sql .'<br>';
        $data = $this->q->exe();
        // var_dump($data);
        return array(
            'orden' => $orden,
            'info' => $info,
            'body'=>$data,
        );
    }
    // ----- version 2: todo
    function getDeclarativo_02($in) {
        $ou = '';
        $this->q->fields = array(
            'nombre' => '',
            'etiqueta' => '',
            'grupo' => '',
            'diccionario' => '',
            'tipo' => '',
            'diccionario_nombre' => ''
        );
        $this->q->sql = 'SELECT nombre, etiqueta, grupo_etiqueta, diccionario, tipo, diccionario_nombre
                          FROM venta_' . $in['campania'] . '_campos 
                          ORDER by orden';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $tot = count($data);
        
        $fields = array('asesor_venta_id'=> '', 'supervisor_id'=>'', 'coordinador_id'=>'', 'info_create_fecha'=>'', 'id'=>'');
        $info = array(
            'asesor_venta_id' => array('diccionario'=>'0', 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>''),
            'supervisor_id' => array('diccionario'=>'0'  , 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>''),
            'coordinador_id' => array('diccionario'=>'0' , 'tipo'=>'VARCHAR', 'diccionario_nombre' => '', 'nombre'=>''),
            'info_create_fecha' => array('diccionario'=>'0' , 'tipo'=>'TIMESTAMP-VARCHAR', 'diccionario_nombre' => '', 'nombre'=>''),
            'id' => array('diccionario'=>'0', 'tipo'=>'VARCHAR', 'diccionario_nombre' => '')
        );
        $head = array(array('name'=>'Responsables', 'items'=>'5',
                            'list' => array('Asesor Venta', 'Supervisor', 'Coordinador','Fecha Creacion','Id')));
         
        for ($i=0; $i<$tot; $i++) {
            $fields[$data[$i]['nombre']] = '';
            $info[$data[$i]['nombre']] = array(
                'diccionario'=> $data[$i]['diccionario'],
                'tipo'=>$data[$i]['tipo'],
                'diccionario_nombre' => $data[$i]['diccionario_nombre'],
                'nombre'=> $data[$i]['nombre'],
            );
            if (utf8_encode($data[$i]['grupo'])=='') {
                $head[] = array('name'=>utf8_encode($data[$i]['etiqueta']), 'items'=>1, 'list'=>array(utf8_encode($data[$i]['etiqueta'])));
            } else {
                if (($i>0 && utf8_encode($data[$i]['grupo']) != utf8_encode($data[$i-1]['grupo'])) || $i==0) {
                    $k = 0;
                    $l = array();
                    for ($j=$i; $j < $tot; $j++) {                        
                        if (utf8_encode($data[$i]['grupo']) != utf8_encode($data[$j]['grupo'])) {
                            break;
                        }
                        $l[] = utf8_encode($data[$j]['etiqueta']);
                        $k++;               
                    }
                    $head[] = array('name'=>utf8_encode($data[$i]['grupo']), 'items'=>$k, 'list' => $l);
                }
            }
        }
        // datos --------------------------------------------------------
        $this->q->fields = $fields;
        $this->q->sql = '
         SELECT  av.nombre, su.nombre, co.nombre, v.info_create_fecha, d.* 
         FROM venta v
         JOIN usu_usuario av ON av.id = v.asesor_venta_id 
         JOIN usu_usuario su ON su.id = v.supervisor_id
         JOIN usu_usuario co ON co.id = v.coordinador_id
         JOIN venta_' . $in['campania'] . ' d ON d.id=v.id
         WHERE v.info_status=1 ';
        if(trim($_SESSION['lineas']) != '') {
            $this->q->sql.= ' AND v.lineal_id IN (' . $_SESSION['lineas'] . ')';
        }
        if (trim($in['ini'])!='') {
            $this->q->sql.= ' AND v.info_create_fecha >= "' . $in['ini'] . ' 00:00:00"';
        }
        if (trim($in['end'])!='') {
            $this->q->sql.= ' AND v.info_create_fecha <= "' . $in['end'] . ' 23:59:59"';
        }
             
        $data = $this->q->exe();
        // echo '<pre>';
        // print_r($in);
        // echo '</pre>';
        // echo '<pre>';
        // echo $this->q->sql;
        // echo '</pre>';
        // echo '<pre>';
        // print_r($head);
        // echo '</pre>';
        // echo '<hr>';
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
         
        return array('head'=>$head, 'info' => $info, 'body'=>$data);
    }
    function getDeclarativo_value($valor, $info) {
        $ou = '';
        if ($info['diccionario']!='0') {
            $this->q->fields = array('nombre' => '');
            if ($info['diccionario_nombre'] == '') 
                $this->q->sql = 'SELECT nombre FROM venta_' . $info['nombre'] . ' WHERE id="' . $valor . '"';
            else
                $this->q->sql = 'SELECT nombre FROM venta_' . $info['diccionario_nombre'] . ' WHERE id="' . $valor . '"';
            // echo $this->q->sql.'<br>';                
            $this->q->data = NULL;
            $data = $this->q->exe();
            $ou = $data[0]['nombre'];
        } else {
            if ('TIMESTAMP' == strtoupper($info['tipo'])) {
                $ou = trim(substr($valor, 0, 10));
            } else {
                $ou = $valor;
            }
        }
        return utf8_encode(trim($ou));
    }
    // timer structura
    function getTimerEstructura($in) {
        $ou = '';
        $this->q->fields = array(
            'timestamp' => '',

        );
        $sql_lineas = '';
        if ('' != trim($in['lineas'])) {
            $sql_lineas = 'WHERE lineal_id IN (' . $in['lineas'] . ')';
        }
        $this->q->sql = '
                        SELECT info_update_fecha FROM venta 
                        ' . $sql_lineas . '           
                        ORDER BY info_update_fecha DESC LIMIT 1  
                        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return strtotime($data[0]['timestamp']);
    }
    function getTimerRepoirteEstructura($campania_id, $lineas) {
        $this->q->fields = array(
            'campania' => '',
            'dato01' => '',
            'dato02' => '',
            'dato03' => '',
            'dato04' => '',
            'dato05' => '',
            'dato06' => '',            
        );
        $this->q->sql = '
                        CALL ventas_timer_reporte_estructura(
                          "' . (int) $campania_id . '",
                          "' . $lineas . '"
                        )
                        ';
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }// aqui
    function getCampaniaIdByLinealId($in) {
        $this->q->fields = array(
            'campania_id' => '',            
        );
        $this->q->sql = '
                        SELECT DISTINCT cl.campania_id 
                        FROM campania_lineal cl
                        ';
        if ('' != trim($in['lineas'])) {
            $this->q->sql .= ' WHERE cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getTimerEstructuraListado($in) {
        $campanias = $this->getCampaniaNombreByLinealId($in);
        $this->q->fields = array(
            'id' => '',
            'fecha' => '',
            'documento' => '',
            'cliente' => '',
            'campania' => '',
            'indice' => '',
            'supervisor' => '',
            'asesor_venta' => '',
        );
        $this->q->sql = '';        

        if (isset($campanias)) {
            $sql_proceso = '';
            if ($in['proceso'] == '1') {
                $sql_proceso .= '    d.aprobado_supervisor = 2 
                                 AND d.tramitacion_venta_validar = 2 
                                 AND d.tramitacion_venta_cargar = 2
                                 AND d.tramitacion_postventa_validar = 2
                                 AND d.tramitacion_postventa_citar = 2
                                 AND d.tramitacion_postventa_intalar = 2
                                 AND
                                ';
            } elseif ($in['proceso'] == '2') {
                $sql_proceso .= '    d.aprobado_supervisor = 1 
                                 AND d.tramitacion_venta_validar = 2 
                                 AND d.tramitacion_venta_cargar = 2
                                 AND d.tramitacion_postventa_validar = 2
                                 AND d.tramitacion_postventa_citar = 2
                                 AND d.tramitacion_postventa_intalar = 2
                                 AND
                                ';
            } elseif ($in['proceso'] == '3') {
                $sql_proceso .= '    d.aprobado_supervisor = 1 
                                 AND d.tramitacion_venta_validar = 1 
                                 AND d.tramitacion_venta_cargar = 2 
                                 AND d.tramitacion_postventa_validar = 2
                                 AND d.tramitacion_postventa_citar = 2
                                 AND d.tramitacion_postventa_intalar = 2
                                 AND
                                ';
            } elseif ($in['proceso'] == '4') {
                $sql_proceso .= '    d.aprobado_supervisor = 1
                                 AND d.tramitacion_venta_validar = 1
                                 AND d.tramitacion_venta_cargar = 1
                                 AND d.tramitacion_postventa_validar = 2
                                 AND d.tramitacion_postventa_citar = 2
                                 AND d.tramitacion_postventa_intalar = 2
                                 AND
                                ';
            } elseif ($in['proceso'] == '5') {
                $sql_proceso .= '    d.aprobado_supervisor = 1 
                                 AND d.tramitacion_venta_validar = 1 
                                 AND d.tramitacion_venta_cargar = 1 
                                 AND d.tramitacion_postventa_validar = 1
                                 AND d.tramitacion_postventa_citar = 2
                                 AND d.tramitacion_postventa_intalar = 2
                                 AND
                                ';
            } elseif ($in['proceso'] == '6') {
                $sql_proceso .= '    d.aprobado_supervisor = 1 
                                 AND d.tramitacion_venta_validar = 1 
                                 AND d.tramitacion_venta_cargar = 1 
                                 AND d.tramitacion_postventa_validar = 1
                                 AND d.tramitacion_postventa_citar = 1
                                 AND d.tramitacion_postventa_intalar = 2
                                 AND
                                ';
            } else {
                $sql_proceso .= '    d.aprobado_supervisor = 1 
                                 AND d.tramitacion_venta_validar = 1 
                                 AND d.tramitacion_venta_cargar = 1 
                                 AND d.tramitacion_postventa_validar = 1
                                 AND d.tramitacion_postventa_citar = 1
                                 AND d.tramitacion_postventa_intalar = 1
                                 AND
                                ';
            }
            $sql_lineas = '';
            if ('' != trim($in['lineas'])) {
                $sql_lineas = 'AND v.lineal_id IN (' . $in['lineas'] . ')'; 
            }
            
            foreach($campanias as $row) {
                if ($this->q->sql != '')
                    $this->q->sql .= ' UNION ';
                $this->q->sql .= '
                SELECT v.id, v.info_create_fecha, d.cliente_documento, d.cliente_nombre, "' . $row['nombre'] . '", "' . $row['indice'] . '", s.nombre supervisor , a.nombre asesor
                FROM venta_' . $row['indice'] . ' d
                JOIN venta v ON v.id = d.id
                JOIN usu_usuario a ON a.id = v.asesor_venta_id
                JOIN usu_usuario s ON s.id = v.supervisor_id
                WHERE ' . $sql_proceso . ' v.info_status = 1 ' . $sql_lineas . '
                ';
            }
        }
        $this->q->sql = 'SELECT * FROM (' . $this->q->sql . ') as unido ORDER BY 2 ASC';
        // Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function setTimerEstructuraSave($in) {
        $this->q->fields = array();
        $procesar = true;
        $sql_proceso='';
        if ($in['proceso'] == '1') {
            $sql_proceso='aprobado_supervisor = 1';
        } elseif ($in['proceso'] == '2') {
            $sql_proceso='tramitacion_venta_validar = 1';
        } elseif ($in['proceso'] == '3') {
            $sql_proceso='tramitacion_venta_cargar = 1';
        } elseif ($in['proceso'] == '4') {
            $sql_proceso='tramitacion_postventa_validar = 1';
        } elseif ($in['proceso'] == '5') {
            $sql_proceso='tramitacion_postventa_citar = 1';
        } elseif ($in['proceso'] == '6') {
            $sql_proceso='tramitacion_postventa_intalar = 1';
        } else {
            $procesar = false;
        }
        if ($procesar)
        {
            $this->q->sql = '
            UPDATE venta_' . $in['campania'] . ' SET ' . $sql_proceso . '
            WHERE id = "' . $in['venta_id'] . '"
            ';
            // echo $this->q->sql;        
            $this->q->data = NULL;
            $this->q->exe();
            //
            $this->q->sql = '
            UPDATE venta SET info_update_fecha = "' . $in['fecha'] . '", info_update_user = "' . $in['usuario'] . '"
            WHERE id = "' . $in['venta_id'] . '"
            ';
            // echo $this->q->sql;        
            $this->q->data = NULL;
            $this->q->exe();
        }
    }
    // timer por_aprobar
    function getTimerPorAprobar($in) {
        $ou = '';
        $this->q->fields = array(
            'timestamp' => '',
        );
        $sql_lineas = '';
        if ('' != trim($in['lineas'])) {
            $sql_lineas = 'WHERE lineal_id IN (' . $in['lineas'] . ')';
        }
        $this->q->sql = '
                        SELECT info_update_fecha FROM venta 
                        ' . $sql_lineas . '           
                        ORDER BY info_update_fecha DESC LIMIT 1  
                        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return strtotime($data[0]['timestamp']);
    }
    function getTimerRepoirtePorAprobar($campania, $lineas) {
        $this->q->fields = array(
            'cnt' => '',
        );
        $this->q->sql = '
                        SELECT COUNT(v.id) 
                        FROM venta_' . $campania . ' d
                        JOIN venta v ON v.id = d.id 
                        WHERE d.aprobado_supervisor = 2 AND v.info_status = 1 AND v.lineal_id IN (' . $lineas . ')
                        ';
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        $ou['cnt'] = $data[0]['cnt'];

        $this->q->fields = array(
            'date' => '',
        );
        $this->q->sql = '
                        SELECT v.info_create_fecha
                        FROM venta_' . $campania . ' d
                        JOIN venta v ON v.id = d.id 
                        WHERE d.aprobado_supervisor = 2 AND v.lineal_id IN (' . $lineas . ')
                        ORDER BY 1 desc
                        LIMIT 1
                        ';
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        $ou['date'] = $data[0]['date'];
        return $ou;
    }
    function getCampaniaNombreByLinealId($in) {
        $this->q->fields = array(
            'indice' => '',
            'nombre' => '',
        );
        $this->q->sql = '
                        SELECT DISTINCT c.indice, c.nombre
                        FROM campania_lineal cl
                        JOIN campania c ON c.id = cl.campania_id 
                        WHERE  c.venta=1
                        ';
        if ('' != trim($in['lineas'])) {
            $this->q->sql.= 'AND  cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getVentasPorAprobar($in) {
        $this->q->fields = array(
            'id' => '',
            'fecha' => '',
            'asesor_venta' => '',
        );
        $this->q->sql = '
                        SELECT v.id, v.info_create_fecha, a.nombre
                        FROM venta_' . $in['campania'] . ' d
                        JOIN venta v ON v.id = d.id
                        JOIN usu_usuario a ON a.id = v.asesor_venta_id
                        WHERE d.aprobado_supervisor = 2 AND v.info_status = 1 AND v.lineal_id IN (' . $in['lineas'] . ')
                        ORDER BY 1 asc
                        ';
        // echo $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function setVentaPorAprobar($in) {
        $this->q->fields = array();
        $this->q->sql = '
        UPDATE venta_' . $in['campania'] . ' SET aprobado_supervisor = 1
        WHERE id = "' . $in['venta_id'] . '"
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $this->q->exe();
        //
        $this->q->sql = '
        UPDATE venta SET info_update_fecha = "' . $in['fecha'] . '", info_update_user = "' . $in['usuario'] . '"
        WHERE id = "' . $in['venta_id'] . '"
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $this->q->exe();

    }
    
    // ----------------------------- Editable-Inline
    function getCampaniaEditable($ventaId) {
        $this->q->fields = array(
            'campania' => '',            
        );
        $this->q->sql = '
                        SELECT campania FROM venta where id = ' . $ventaId . '
                        ' ;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['campania'];
    }
    function getEstadoTramitacionIdEditable($in) {
        $this->q->fields = array(
            'estado_real' => '',            
        );
        $this->q->sql = '
                        SELECT estado_tramitacion FROM venta_' . $in['campania'] . ' WHERE id = "' . $in['venta_id'] . '"
                        ' ;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['estado_real'];
    }
    function getValorEditable($in) {
        $this->q->fields = array(
            'valor' => '',            
        );
        $this->q->sql = '
                        SELECT ' . $in['campo']  . ' FROM ' . $in['tabla'] . ' WHERE id = "' . $in['venta_id'] . '"
                        ' ;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['valor'];
    }
    function setValorEditable($in) {
        $this->q->fields = array(
        );
        $this->q->data = NULL;
        $this->q->sql = '
                        UPDATE ' . $in['tabla'] . ' SET ' . $in['campo']  . ' = "' . $in['valor']  . '" 
                        WHERE id = "' . $in['venta_id'] . '"
                        ' ;
        // print $this->q->sql;
        $this->q->exe();
        $this->q->data = NULL;
        $this->q->sql = '
                        UPDATE venta SET info_update_fecha  = "' . $in['fecha']  . '" 
                        WHERE id = "' . $in['venta_id'] . '"
                        ' ;
        // print $this->q->sql;
        $this->q->exe();
    }
    function setSQL($fields, $sql) {
        $this->q->fields = $fields;
        $this->q->sql = $sql;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    
    // ----------------------------- Transparencia
    function drawLogItem($tabla, $campo, $old, $new) {
        $ou = '';
        if ($tabla == 'venta') {
            if ($campo == 'asesor_venta_id' || $campo == 'supervisor_id') {
                $this->q->fields = array(
                    'id' => '' , 'nombre' => ''
                );
                $this->q->data = NULL;
                $this->q->sql = '
                SELECT id, nombre FROM usu_usuario  WHERE 
                id = "' . $old . '" OR id = "' . $new . '"
                ' ;
                // print $this->q->sql;
                $datos =  $this->q->exe();
                if (isset($datos[0]) && $datos[0]['id'] == $old) $old2 = $datos[0]['nombre'];
                if (isset($datos[0]) && $datos[0]['id'] == $new) $new2 = $datos[0]['nombre'];
                if (isset($datos[1]) && $datos[1]['id'] == $old) $old2 = $datos[1]['nombre'];
                if (isset($datos[1]) && $datos[1]['id'] == $new) $new2 = $datos[1]['nombre'];
                $old = $old2;
                $new = $new2;
                if ($campo == 'asesor_venta_id') $campo = 'Asesor de Venta';
                if ($campo == 'supervisor_id') $campo = 'Supervisor';
            }
        } else {
            $this->q->fields = array(
                'dic' => '' , 'dic_nm' => '', 'etiqueta' => ''
            );
            $this->q->data = NULL;
            $this->q->sql = '
            SELECT diccionario,  diccionario_nombre, etiqueta 
            FROM `venta_campania_001_campos` 
            WHERE nombre = "' . $campo . '" LIMIT 1
            ';
            // print $this->q->sql;
            $dato =  $this->q->exe();
            // print_r($dato);
            $campo2 = $dato[0]['etiqueta'];
            if (isset($dato[0]) && $dato[0]['dic'] != '0') {
                if('' == trim($dato[0]['dic_nm'])) {
                    $diccionario = 'venta_' . $campo;
                } else {
                    $diccionario = 'venta_' . $dato[0]['dic_nm'];
                }               
                $this->q->fields = array(
                    'id' => '' , 'nombre' => ''
                );
                $this->q->data = NULL;
                $this->q->sql = '
                SELECT id, nombre FROM ' . $diccionario . '  WHERE 
                id = "' . $old . '" OR id = "' . $new . '"
                ' ;
                // print $this->q->sql;
                $datos =  $this->q->exe();
                // print_r($datos);
                
                if (isset($datos[0]) && $datos[0]['id'] == $old) $old2 = $datos[0]['nombre'];
                if (isset($datos[0]) && $datos[0]['id'] == $new) $new2 = $datos[0]['nombre'];
                if (isset($datos[1]) && $datos[1]['id'] == $old) $old2 = $datos[1]['nombre'];
                if (isset($datos[1]) && $datos[1]['id'] == $new) $new2 = $datos[1]['nombre'];
                $old = $old2;
                $new = $new2;
            }
            $campo = $campo2;
        }
        
        $ou.= '{';
        $ou.= '"nombre": "' . $campo . '",';
        $ou.= '"old": "' . $old . '",';
        $ou.= '"new": "' . $new . '"';
        $ou.= '}';
        return $ou;
    }
    function drawDivLogItem($campania, $venta, $usuario, $fecha, $campos) {
        $ou = '';

        $this->q->fields = array(
            'nombre' => ''
        );
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT nombre FROM `usu_usuario` WHERE id = "' . $usuario . '"
        LIMIT 1
        ' ;
        // print $this->q->sql;
        $dato = $this->q->exe();        
        
        $ou.= '{';
        $ou.= '"usuario": "' . $dato[0]['nombre'] . '", ';
        $ou.= '"fecha": "' . $fecha . '", ';
        $ou.= '"campos": [' . $campos . '] ';
        $ou.= '}';        
        // echo $ou;
        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = "
        INSERT INTO transparencia_" . $campania . "(venta_id, json) VALUES
        ('" . $venta . "', '" . $ou . "')
        ";
        // print $this->q->sql;
        $this->q->exe();
    }
    function getTransparenciaByVentaId($in) {
        $this->q->fields = array(
            'json' => '',            
        );
        $this->q->sql = '
       SELECT json FROM `transparencia_' . $in['campania'] . '` 
       WHERE venta_id = ' . $in['venta_id'] . '
       ORDER BY id DESC
       ' ;
        // print $this->q->sql .'<br>';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }

    // ------------------------------ Listado
  function getListado($name) {
    $this->q->fields = array(
      'id' => '',
      'nombre' => '',
    );
    $this->q->sql = '
        SELECT id, nombre FROM venta_' . $name . ' WHERE info_status=1';
    // echo $this->q->sql;
    $this->q->data = NULL;
    $data = $this->q->exe();
    return $data;
  }
}
