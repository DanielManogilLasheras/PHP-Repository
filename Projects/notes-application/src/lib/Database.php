<?php

namespace Dmano\Notes\lib;

use PDO;
use PDOException;

class Database
{
    private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $charset;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'notes';
        $this->user = 'root';
        $this->password = '';
        $this->charset = 'utf8mb4';
    }
    public function connect()
    {
        try {
            $connection = " mysql:host={$this->host};dbname={$this->db};charset{$this->charset}";
            $pdo = new PDO($connection, $this->user, $this->password);
            return $pdo;
        } catch (PDOException $e) {
            echo "exception...";
            print $e->getMessage() . "\n";
            printf(format: (int)$e->getCode() . "\n");
        }
    }
}
