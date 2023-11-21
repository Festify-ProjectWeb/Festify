<?php
//database.php

class Database{
    private static $instance = null;
    private $conn;

    private function __construct() {
        global $databaseConfig;

        $this->conn = new mysqli(
            $databaseConfig["servername"],
            $databaseConfig["username"],
            $databaseConfig["password"],
            $databaseConfig["dbname"]
        );
        if ($this->conn->connect_error) {
            die("Falha na conexão: ". $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    private function __clone() {}
}

?>