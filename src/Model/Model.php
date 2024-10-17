<?php
namespace Model;
use PDO;
class Model
{
    protected static PDO $pdo;
    public static function getPdo()
    {
        if(!isset(self::$pdo)){
            $db = getenv("DB_NAME");
            $user = getenv("DB_USER");
            $password = getenv("DB_PASSWORD");
            $host = getenv("DB_HOST");
            $port = getenv("DB_PORT");
            self::$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $password);

        }
        return self::$pdo;
    }
    public static function beginTransaction()
    {
        self::getPdo()->beginTransaction();
    }

    public static function commit()
    {
        self::getPdo()->commit();
    }

    public static function rollBack()
    {
        self::getPdo()->rollBack();
    }
}