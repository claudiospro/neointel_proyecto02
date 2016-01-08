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

    static function logOut() {
        session_destroy(); 
    }

    static function logIn($in) {
        $q = new Query();
        $q->fields = array('modulo' => '', 'user_id' => '');
        $q->sql = '
        SELECT DISTINCT r.nombre, u.id
        FROM usu_usuario u
        LEFT JOIN usu_usuario_perfil up ON up.usuario_id=u.id
        LEFT JOIN usu_perfil_recurso pr ON pr.perfil_id=up.perfil_id
        LEFT JOIN usu_recurso r ON r.id=pr.recurso_id
        WHERE u.nombre = "' . $in['nombre'] . '"
        AND u.pwd ="' . crypt($in['pwd'], '$4a$85$estoesparati$') . '"
        ';
        // print $q->sql;
        
        $q->data = NULL;
        $data = $q->exe();        
        if ($data) {            
            $_SESSION["user_name"] = $in['nombre'];
            $_SESSION["user_id"] = $data[0]['user_id'];
            $resources = ' ';
            foreach ($data as $row) {
                $resources .= ' ' . $row['modulo'];
            }
            $_SESSION["resources"] = $resources;
        }
    }

}


?>