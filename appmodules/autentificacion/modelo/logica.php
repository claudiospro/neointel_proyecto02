<?php 
session_start();
// funciones

class ModeloAuten {
    static function exist() {
        if( isset($_SESSION['user_id']) ) {
            return True;
        } else {
            return False;
        }
    }
    static function user_log($modulo, $url_exit) {
        $exit = False;
        if( isset($_SESSION['user_id']) ) {
            $lista = explode(" ", $_SESSION['resources'] );
            //var_dump($lista);
            if ( array_search($modulo, $lista ) == False ) {
                $exit = True;
            }
        } else {
            $exit = True;
        }
        if ( $exit==True ) {
            header('Location: '.$url_exit);
        }
    }
    static function user_log_0($url_exit) {
        $exit = False;
        if(!isset($_SESSION['user_id']) ) {
            header('Location: '.$url_exit);
        }
    }
    static function logOut() {
        session_destroy(); 
    }
    static function logIn($in) {
        $q = new Query();
        $q->fields = array('modulo' => '', 'user_id' => '', 'user_full_name' => '');
        $q->sql = '
        SELECT DISTINCT r.nombre, u.id, u.nombre
        FROM usu_usuario u
        LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
        LEFT JOIN usu_perfil_recurso pr ON pr.perfil_id=up.perfil_id
        LEFT JOIN usu_recurso r ON r.id=pr.recurso_id
        WHERE u.login = "' . $in['nombre'] . '"
        AND u.pwd ="' . crypt($in['pwd'], '$4a$85$estoesparati$') . '"
        ';
        $q->data = NULL;
        $data = $q->exe();        
        if ($data) {
            $_SESSION["user_name"] = utf8_encode($in['nombre']);
            $_SESSION["user_full_name"] = utf8_encode($data[0]['user_full_name']);
            $_SESSION["user_id"] = $data[0]['user_id'];
            $resources = ' ';
            foreach ($data as $row) {
                $resources .= ' ' . $row['modulo'];
            }
            $_SESSION["resources"] = $resources;
            $q->fields = array('linea' => '');
            $q->sql = '
            SELECT ul.lineal_id
            FROM usu_usuario u
            JOIN usu_usuario_lineal ul ON ul.usuario_id=u.id
            WHERE u.id="' . $_SESSION["user_id"] . '"';
            // print $q->sql;
            $q->data = NULL;
            $data = $q->exe();
            // var_dump($data);
            if ($data) {
                $lineas = ' ';
                foreach ($data as $row) {
                    if ($lineas != ' ') {
                        $lineas .= ', ';    
                    }
                    $lineas .= $row['linea'];
                }
                $_SESSION["lineas"] = $lineas;
            } else {
                $_SESSION["lineas"] = '';
            }
            $q->fields = array('id' => '', 'perfil' => '');
            $q->sql = '
            SELECT p.id, p.nombre
            FROM usu_usuario u
            LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
            LEFT JOIN usu_perfil p ON p.id=up.perfil_id
            WHERE u.id="' . $_SESSION["user_id"] . '"';            
            // echo $q->sql;
            $q->data = NULL;
            $data = $q->exe();
            // var_dump($data);
            if ($data) {
                $perfiles = '';
              $perfiles_id = '';
                foreach ($data as $row) {
                    $perfiles .= ' ' . $row['perfil'];
                    $perfiles_id .= ' ' . $row['id'];
                }
                $_SESSION["perfiles"] = $perfiles;
                $_SESSION["perfiles_id"] = trim($perfiles_id);
            }            
        }
    }
    static function changePWD($in) {
        $q = new Query();
        $q->fields = array('id' => '');
        $q->sql = '
        SELECT id FROM usu_usuario WHERE 
        login="' . $in['login'] . '" AND
        pwd = "' . crypt($in['pwd-old'], '$4a$85$estoesparati$') . '"
        ';
        $q->data = NULL;
        $data = $q->exe();
        if ($data && $in['pwd-new-1'] == $in['pwd-new-2']) {
            $q->fields = array('id' => '');
            $q->sql = '
            UPDATE usu_usuario SET pwd="' . crypt($in['pwd-new-1'], '$4a$85$estoesparati$') . '" WHERE id="' . $in['user_id'] . '"
            ';
            // print $q->sql;
            $q->data = NULL;
            $q->exe();
        }
    }
}


?>
