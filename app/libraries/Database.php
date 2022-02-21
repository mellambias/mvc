<?php
/*
* Clase base de datos
* Conectar a la bd
* Preparar las consultas
* Binds de PDO
* devolver los registros
*/
class Database{
    private $host = DB_HOSTS;
    private $user = DB_USER;
    private $port = DB_PORT;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $con; //conexion
    private $stmt;      //consulta o sentencia
    private $error;

    public function __construct(){
        $dsn = 'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname;
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try{
            $this->con = new PDO($dsn, $this->user, $this->pass,$options);
        }catch(PDOException $e){
            $this->error = $e;
            echo $e;
            exit();
        }
    }

    public function query($sql){
        // ejecutara el prepare de la conexion
        $this->stmt = $this->con->prepare($sql);
    }

    public function bind($param, $valor, $type=null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $valor, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // devuelve el numero de registros
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}
?>