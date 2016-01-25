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
                $ou = '<input name="' . $campo['nombre'] . '" type="text" value="' . $ou . '" class="no-margin">';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP') {
                $ou = '<div class="input-group datapicker-simple">
                          <input name="' . $campo['nombre'] . '" type="text" class="no-margin" value="' . substr($ou, 0, 10) . '" readonly>
                          <a class="input-group-label" title="Limpiar"><i class="fi-calendar size-24"></i></a>
                         </div>
                        ';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TIMESTAMP-VARCHAR') {
                $ou = '<div class="input-group">
                          <input name="' . $campo['nombre'] . '" type="text" class="no-margin" value="' . $ou . '" >
                          <i class="input-group-label fi-calendar size-24"></i>
                         </div>
                        ';
            } elseif ($campo['diccionario']=='0' && $campo['tipo']=='TEXT') {
                $ou = '<textarea name="' . $campo['nombre'] . '" rows="2">' . $ou . '</textarea>
                        ';
            } elseif ($campo['diccionario']=='1') {
                $this->q->fields = array('nombre' => '');
                $this->q->sql = '
                SELECT nombre FROM venta_' . $campo['nombre'] . ' WHERE id="' . $dato . '"';
                // echo $this->q->sql;        
                $this->q->data = NULL;
                $data = $this->q->exe();
                $data = $data[0]['nombre'];
                $ou = '<input name="' . $campo['nombre'] . '" 
                              type="text" 
                              class="autocomplete no-margin active" 
                              campo="' . $campo['nombre'] . '" 
                              value="' . utf8_encode($data) . '">';
            } elseif ($campo['diccionario']=='2') {
                $ou = '<select name="' . $campo['nombre'] . '">';
                $ou.= '<option value="0"></option>';
                $this->q->fields = array('id' => '', 'nombre' => '');
                $this->q->sql = '
                SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1';
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
            } elseif ($campo['diccionario']=='3') {
                $ou = '<select name="' . $campo['nombre'] . '">';
                $this->q->fields = array('id' => '', 'nombre' => '');
                $this->q->sql = '
                SELECT id, nombre FROM venta_' . $campo['nombre'] . ' WHERE info_status=1 and campania="' . $campania . '"';
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
                $ou = '<input name="' . $campo['nombre'] . '" type="text" value="' . $ou . '" class="no-margin" style="color:red">';
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
}
