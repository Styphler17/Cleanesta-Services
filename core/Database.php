<?php
namespace Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
            try {
                self::$connection = new PDO(
                    $dsn,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'
                    ]
                );
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$connection;
    }
}

// For legacy code that relies on $connexion
$GLOBALS['connexion'] = Database::getConnection();
