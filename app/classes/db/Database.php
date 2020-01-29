<?php

namespace Db;

class Database
{
    public static $host = 'remotemysql.com';
    public static $dbName = 'BLojzvsxpf';
    public static $username = 'BLojzvsxpf';
    public static $password = 'TQEfQZrHiF';

    private static function connect()
    {
        try {
            $dataSourceName = 'mysql:host='.self::$host.';dbname='.self::$dbName;
            $pdo = new \PDO($dataSourceName, self::$username, self::$password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (\PDOException $e) {
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
