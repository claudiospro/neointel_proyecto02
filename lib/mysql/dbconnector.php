<?php
class DBConnector_Alternative {
    public  $servername = 'localhost';
    public  $username = 'root';
    public  $password = 'allemant';
    public  $dbname = 'neointelperu_apps';
}
class DBConnector {
    protected static $conn;
    protected static $stmt;
    protected static $reflection;
    protected static $sql;
    protected static $data;
    public static $results;
    
    private static $db_host = 'localhost';
    private static $db_user = 'root';
    private static $db_pass = 'allemant';
    protected static $db_name = '';
	
    // private static $db_host = 'localhost';
    // private static $db_user = 'root';
    // private static $db_pass = 'admin';
    // protected static $db_name = 'allemant02';

    protected static function conectar() {
	self::$conn = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
    }
    protected static function preparar() {
	self::$stmt = self::$conn->prepare(self::$sql);
	self::$reflection = new ReflectionClass('mysqli_stmt');
    }
    protected static function set_params() {
	$method = self::$reflection->getMethod('bind_param');
        if (self::$data!=NULL) {
            $method->invokeArgs(self::$stmt, self::$data);
        }
	
    }
    protected static function get_data($fields) {
	$method = self::$reflection->getMethod('bind_result');
	$method->invokeArgs(self::$stmt, $fields);

	while(self::$stmt->fetch()) {
	    self::$results[] = unserialize(serialize($fields));
	}
    }
    protected static function finalizar() {
	self::$stmt->close();
	self::$conn->close();
    }
    public static function set_db($name){
        self::$db_name=$name;
    }
    public static function ejecutar($sql, $data, $fields=False) {
	self::$sql = $sql;
	self::$data = $data;
	self::conectar();
	self::preparar();
	self::set_params();
	self::$stmt->execute();
	if($fields) {
	    self::get_data($fields);
	} else {
	    if(strpos(self::$sql, strtoupper('INSERT')) === 0) {
		return self::$stmt->insert_id;
	    }
	}
	self::finalizar();
    }
}
?>
