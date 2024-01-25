<?php

namespace app;

class Connection
{
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;

    public $pdo;

    function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->port = $_ENV['DB_PORT'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }

    public function getConnection()
    {
        $this->pdo = null;
        try {
            $this->pdo = new \PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $this->password); 
            $this->pdo->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }
        return $this->pdo;
    }
}