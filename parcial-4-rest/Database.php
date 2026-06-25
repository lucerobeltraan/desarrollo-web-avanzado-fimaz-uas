<?php
class Database {
    private $host = "localhost";
    private $port = "3307";
    private $db_name = "futbolistas";
    private $username = "root";
    private $password = "Lucerito99";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                                  $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo json_encode(["error" => "Error de conexión: " . $exception->getMessage()]);
        }
        return $this->conn;
    }
}
