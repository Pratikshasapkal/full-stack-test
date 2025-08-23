<?php
class Database {
    private static ?\PDO $pdo = null;

    public static function connect(): \PDO {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/config.php';
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            
            try {
                self::$pdo = new \PDO(
                    $dsn,
                    $config['user'],
                    $config['pass'],
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                    ]
                );
            } catch (\PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
