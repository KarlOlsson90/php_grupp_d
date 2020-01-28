<?php

class Database
{
    public static $host = '127.0.0.1';
    public static $dbName = 'loginsystem';
    public static $username = 'root';
    public static $password = 'gunnahr';

    private static function connect()
    {
        try {
            $dataSourceName = 'mysql:host='.self::$host.';dbname='.self::$dbName;
            $pdo = new PDO($dataSourceName, self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed'.$e->getMessage();
        }
    }

    public static function query($query, $params = array())
    {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);

        $method_string = explode(' ', $query);
        if ($method_string[0] == 'SELECT') {
            $data = $stmt->fetchAll();
            return $data;
        }
    }
}
