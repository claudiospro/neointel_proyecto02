<?php 
class ModeloUsuario {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getGrupo($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT l.id, concat(l.nombre, ": ", u.nombre_corto) nombre
        FROM lineal l
        JOIN usu_usuario_lineal ul ON ul.lineal_id=l.id
        JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id AND up.perfil_id = 4
        JOIN usu_usuario u ON u.id=ul.usuario_id
        WHERE l.info_status = 1        
        ';
        if ('' != trim($in['lineas'])) {
            $this->q->sql .= ' AND ul.lineal_id IN (' . $in['lineas'] . ')';
        }
        $this->q->sql .= ' ORDER BY 2';
        
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getPerfil($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM usu_perfil WHERE 1 = 1
        ';
        if ($in['perfil'] == 'Administracion') {
            $this->q->sql .= 'AND id NOT IN (1, 2, 3, 6, 7, 8, 9)';
        } elseif ($in['perfil'] == 'Coordinador') {
            $this->q->sql .= 'AND id NOT IN (1, 2, 10)';
        } elseif ($in['perfil'] == 'Gerencia') {
            $this->q->sql .= 'AND id NOT IN (1)';
        } elseif ($in['perfil'] == 'Admin') {
            $this->q->sql .= 'AND id NOT IN (0)';
        } else {
            $this->q->sql .= 'AND id NOT IN (1, 2, 3, 6, 7, 8, 9)';
        }
        $this->q->sql .= ' ORDER BY 2';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function getCeseTipo($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT id, nombre FROM usu_cese_tipo WHERE info_status = 1
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    //
    function getUsuario($in) {
        $this->q->fields = array(
            'usuario_id' => '',
            'nombre' => '',
            'nombre_corto' => '',
            'login' => '',
            'pwd' => '',
            'perfil_id' => '',
            'perfil' => '',
            'comentario' => '',
            'telefono' => '',
            'direccion' => '',
            'vigente' => '1',
            'fecha_entrada' => '',
            'fecha_cese' => '',
            'cese_tipo' => '',
            'cese_observacion' => '',
        );
        $this->q->sql = '
        SELECT u.id
             , u.nombre
             , u.nombre_corto
             , u.login
             , u.pwd
             , up.perfil_id
             , p.nombre
             , u.comentario
             , u.telefono
             , u.direccion
             , u.info_status
             , u.fecha_entrada
             , u.fecha_cese
             , u.cese_tipo
             , u.cese_observacion
        FROM usu_usuario u
        LEFT JOIN usu_usuario_perfil up ON up.usuario_id = u.id
        LEFT JOIN usu_perfil p ON p.id = up.perfil_id
        WHERE u.id = "' . $in['usuario_id'] . '"
        ';
        // echo "<textarea rows='30'>{$this->q->sql}</textarea>";
        $this->q->data = NULL;
        if ($in['usuario_id'] != '0') {
            $data = $this->q->exe();
            $data = $data[0];
        } else {
            $data = $this->q->fields;
        }        
        return $data;
    }
    function setUsuario($in) {
        $this->q->fields = array('usuario_id' => '');
        $this->q->data = NULL;
        $this->q->sql = '
        CALL usu_usuario_save(
          "' . $in['form']['usuario_id']. '"
        , "' . ($in['form']['nombre']) . '"
        , "' . ($in['form']['nombre_corto']) . '"
        , "' . ($in['form']['login']) . '"
        , "' . ($in['form']['comentario']) . '"
        , "' . $in['form']['telefono']. '"
        , "' . $in['form']['direccion']. '"
        , "' . $in['form']['vigente']. '"
        , "' . $in['form']['fecha_entrada']. '"
        , "' . $in['form']['fecha_cese']. '"
        , "' . $in['form']['cese_observacion']. '"
        , "' . $in['form']['cese_tipo']. '"
        , "' . $in['form']['perfil_id']. '"
        , "' . $in['fecha'] . '"
        , "' . $in['usuario'] . '"
        )
        ';
        // echo $this->q->sql;
        $data =  $this->q->exe();

        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = '
        DELETE FROM usu_usuario_lineal WHERE
        usuario_id = "' . $in['form']['usuario_id'] . '"
        ';
        $this->q->exe();        
        if(isset($in['form']['lineales']))
        {
            foreach($in['form']['lineales'] as $key => $row)
            {
                $this->q->fields = array();
                $this->q->data = NULL;
                $this->q->sql = '
                INSERT INTO usu_usuario_lineal
                (usuario_id, lineal_id, info_create, info_create_user)
                VALUES (  "' . $data[0]['usuario_id'] . '"
                        , "' . $key . '"
                        , "' . $in['fecha'] . '"
                        , "' . $in['usuario'] . '"
                )
                ';
                // echo $this->q->sql;
                $this->q->exe();
            }
        }
        return $data[0]['usuario_id'];
    }
    function setUsuarioPwd($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = '
        UPDATE usu_usuario SET 
          pwd              = "$4nkNrBEK8ra2" 
        , info_update      = "' . $in['fecha'] . '"
        , info_update_user = "' . $in['usuario'] . '"
        WHERE id = "' . $in['form']['usuario_id']. '"
        ';
        // echo $this->q->sql;        
        $this->q->exe();
    }
    //
    function getGrupoByUsuario($in) {
        $campanias = '';
        if ($in['lineas'] != '') {
            $this->q->fields = array(
                'id' => '',
            );
            $this->q->sql = '
            SELECT DISTINCT c.id FROM campania c 
            JOIN campania_lineal cl ON cl.campania_id = c.id
            WHERE c.info_status = 1
            AND cl.lineal_id IN (' . $in['lineas'] . ')
            ';
            // echo Utilidades::printr($this->q->sql);
            $this->q->data = NULL;
            $data = $this->q->exe();
            foreach ($data as $row) {
                if ($campanias != '')
                    $campanias .= ', ';
                $campanias .= $row['id'];
            }
            
        }
        // --------------------------------
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
            'usuario_id' => '',
            'campania' => '',
        );

        if ($campanias != '' )
            $campanias  = 'AND cl.campania_id in (' . $campanias . ')';
        $this->q->sql = '
        SELECT l.id, l.nombre, ul.usuario_id, c.nombre
        FROM lineal l
        JOIN campania_lineal cl ON cl.lineal_id = l.id
        LEFT JOIN usu_usuario_lineal ul ON ul.lineal_id = l.id and ul.usuario_id = ' . $in['usuario_id']. '
        LEFT JOIN campania c ON c.id = cl.campania_id
        WHERE l.info_status = 1
        ' . $campanias . '  
        ORDER by 2
        ';
        // echo Utilidades::printr($this->q->sql);
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    //
    function updateVigente($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        $fecha = '';
        if ($in['info_status'] == 0) {
            $fecha .= ', fecha_cese = "' . date('Y-m-d') . '"';
        } elseif ($in['info_status'] == 1) {
            $fecha .= ', fecha_entrada = "' . date('Y-m-d') . '"';
            $fecha .= ', fecha_cese = ""';
        }
        
        // estado
        $this->q->sql = '
        UPDATE usu_usuario 
        SET info_status="' . $in['info_status'] . '"
            , info_update_user="' . $in['usuario'] . '"
            , info_update="' . $in['fecha'] . '"
            ' . $fecha . '
        WHERE id="' . $in['id'] . '"
        ';
        // echo $this->q->sql . '\n';
        $this->q->exe();
    }
    //
    function updateUsuarioGrupo($in) {
        $this->q->fields = array('perfil'=>'');
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT p.nombre FROM usu_usuario_perfil up 
        JOIN usu_perfil p ON p.id=up.perfil_id
        WHERE up.usuario_id="' . $in['form']['usuario_id'] . '"
        ';
        $perfil= $this->q->exe();
        $perfil= $perfil[0]['perfil'];

        if ($perfil == 'Asesor Comercial' || $perfil == 'Supervisor') {
            $this->q->fields = array();
            $this->q->data = NULL;
            $this->q->sql = '
            DELETE FROM usu_usuario_lineal WHERE
            usuario_id = "' . $in['form']['usuario_id'] . '"
            ';
            $this->q->exe();
        }
        
        $this->q->fields = array();
        $this->q->data = NULL;
        // estado
        if ($in['form']['estado'] == '1') {
            $this->q->sql = '
                            INSERT INTO usu_usuario_lineal(usuario_id, lineal_id, info_create, info_create_user)
                            VALUES ("' . $in['form']['usuario_id'] . '",
                                    "' . $in['form']['lineal_id'] . '",
                                    "' . $in['fecha'] . '",
                                    "' . $in['usuario'] . '"
                            )
                            ';
        } else {
            $this->q->sql = '
                            DELETE FROM usu_usuario_lineal WHERE
                            usuario_id = "' . $in['form']['usuario_id'] . '" AND 
                            lineal_id = "' . $in['form']['lineal_id'] . '"
                            ';
        } 
        // echo $this->q->sql;
        $this->q->exe();
    }
    //
    function getSupervisorByLineal($id) {
        $this->q->fields = array('nombre'=>'');
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT u.nombre FROM usu_usuario_perfil up 
        JOIN usu_usuario_lineal ul ON ul.usuario_id = up.usuario_id
        JOIN usu_usuario u ON u.id = up.usuario_id 
        WHERE up.perfil_id = 4 AND ul.lineal_id = ' . $id . '
        ';
        $data = $this->q->exe();
        if ( 0 == count($data))
            $ou = '<span style="color:red">Vacio</span>';
        elseif ( 1 == count($data))
            $ou = utf8_encode($data[0]['nombre']);
        else
            $ou = '<span style="color:red">Mas de 1</span>';
        return $ou;
    }
    // --------------------------------------- grupo
    function getGrupoItem($in) {
        $this->q->fields = array(
            'grupo_id' => '',
            'nombre' => '',
            'campania_id' => '',
            'vigente' => '',            
        );
        $this->q->sql = '
        SELECT l.id, l.nombre, cl.campania_id, l.info_status 
        FROM lineal l
        JOIN campania_lineal cl ON cl.lineal_id = l.id
        WHERE l.id = "' . $in['grupo_id'] . '"
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        if ($in['grupo_id'] != '0') {
            $data = $this->q->exe();
            $data = $data[0];
        } else {
            $data = $this->q->fields;
        }        
        return $data;
    }
    function getCampaniasActivas($in) {
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
        );
        $this->q->sql = '
        SELECT DISTINCT c.id, c.nombre FROM campania c 
        JOIN campania_lineal cl ON cl.campania_id = c.id
        WHERE c.info_status = 1 
        ';
        if ($in['lineas'] != '') {
            $this->q->sql .= ' AND cl.lineal_id IN (' . $in['lineas'] . ')';
        }
        $this->q->sql .= ' ORDER BY 2';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function setGrupo($in) {
        $this->q->fields = array('id' => '');
        $this->q->data = NULL;
        $this->q->sql = '
        CALL usu_lineal_save(
          "' . $in['form']['grupo_id']. '"
        , "' . ($in['form']['nombre']) . '"
        , "' . $in['form']['vigente']. '"
        , "' . $in['form']['campania_id']. '"
        , "' . $in['fecha'] . '"
        , "' . $in['usuario'] . '"
        )
        ';
        // echo $this->q->sql;        
        $data = $this->q->exe();        
        return $data[0]['id'];
    }
    //
    function verificar_usuario($in) {
        $ou = '1';
        $this->q->fields = array('id' => '');
        $this->q->data = NULL;
        $this->q->sql = '
        SELECT id FROM usu_usuario where login = "' . $in['dni'] . '"
        ';
        // echo $this->q->sql;
        
        $data = $this->q->exe();
        $i = 0;
        $es_id = false;
        if (isset($data))
            foreach($data as $row) {
                $i++;
                if ($row['id'] == $in['usuario_id']) $es_id = true;
            }
        if ($i == 1 && $es_id) $ou = '1';
        elseif ($i == 0) $ou = '1';
        else $ou = '0';
        
        return $ou;
    }
}
