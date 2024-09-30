<?php
$newConnection = new Connection(); 

$tableName = "students_table";

class Connection {
    private $server = "mysql:host=localhost;dbname=studentdb";
    private $username = "root";
    private $password = "";
    private $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
    protected $conn;

    public function openConnection(): PDO {
        try {
            $this->conn = new PDO($this->server,$this->username,$this->password,$this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "There is a problem is the connection: ".$e->getMessage();   
        }
    }
}