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
        SELECT id, nombre FROM usu_perfil WHERE id != 1
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
            'comentario' => '',
            'vigente' => '',            
        );
        $this->q->sql = '
        SELECT u.id, u.nombre, u.nombre_corto, u.login, u.pwd, up.perfil_id,  u.comentario, u.info_status
        FROM usu_usuario u
        LEFT JOIN usu_usuario_perfil up ON up.usuario_id = u.id
        WHERE u.id = "' . $in['usuario_id'] . '"
        ';
        // echo $this->q->sql;        
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
        $this->q->fields = array();
        $this->q->data = NULL;
        $this->q->sql = '
        CALL usu_usuario_save(
          "' . $in['form']['usuario_id']. '"
        , "' . $in['form']['nombre']. '"
        , "' . $in['form']['nombre_corto']. '"
        , "' . $in['form']['login']. '"
        , "' . $in['form']['comentario']. '"
        , "' . $in['form']['vigente']. '"
        , "' . $in['form']['perfil_id']. '"
        , "' . $in['fecha'] . '"
        , "' . $in['usuario'] . '"
        )
        ';
        // echo $this->q->sql;        
        $this->q->exe();        

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
        $this->q->fields = array(
            'id' => '',
            'nombre' => '',
            'usuario_id' => '',
        );
        $this->q->sql = '
        SELECT l.id, l.nombre, ul.usuario_id FROM lineal l
        LEFT JOIN usu_usuario_lineal ul ON ul.lineal_id=l.id AND ul.usuario_id = "' . $in['usuario_id'] . '"
        WHERE l.info_status = 1
        ORDER BY 1
        ';
        // echo $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    //
    function updateVigente($in) {
        $this->q->fields = array();
        $this->q->data = NULL;
        // estado
        $this->q->sql = '
        UPDATE usu_usuario 
        SET info_status="' . $in['info_status'] . '",
            info_update_user="' . $in['usuario'] . '", 
            info_update="' . $in['fecha'] . '"
        WHERE id="' . $in['id'] . '"
        ';
        // echo $this->q->sql . '\n';
        $this->q->exe();
    }
    //
    function updateUsuarioGrupo($in) {
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
}
