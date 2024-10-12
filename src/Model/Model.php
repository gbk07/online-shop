<?php
namespace Model;
use PDO;
class Model
{
    protected PDO $pdo;
    public function __construct()
    {
        $db = getenv("DB_NAME");
        $user = getenv("DB_USER");
        $password = getenv("DB_PASSWORD");
        $host = getenv("DB_HOST");
        $port = getenv("DB_PORT");
        $this->pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $password);

    }
}