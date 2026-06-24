<?php
namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private string $host = 'localhost';
    private string $dbname = 'productos';
    private string $username = 'root';
    private string $password = 'Lucerito99';
    private ?PDO $connection = null;

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
