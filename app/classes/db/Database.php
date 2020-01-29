<?php

namespace Db;

// Handles everything regarding connection to database.
class Database
{

    // Connection information to remote MYSQL.
    private static $host = 'remotemysql.com';
    private static $dbName = 'BLojzvsxpf';
    private static $username = 'BLojzvsxpf';
    private static $password = 'TQEfQZrHiF';

    // Connecting to database.
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

    // Prepared statements for database querys.
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
