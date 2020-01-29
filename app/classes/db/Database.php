<?php

namespace Db;

class Database
{
    private static $host = 'remotemysql.com';
    private static $dbName = 'BLojzvsxpf';
    private static $username = 'BLojzvsxpf';
    private static $password = 'TQEfQZrHiF';

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

    protected static function query($query, $params = array())
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
