<?php

namespace App\Parent;

use App\Exception\DatabaseConnectionException;
use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;

class SinglePdo
{
    private static ?PDO $instance = null;
    private const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    final public static function getInstance()
    {
        if (self::$instance == null) {
            (new Dotenv())->loadEnv(__DIR__.'/../../.env');
            $dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'];
            try {
                self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], self::OPTIONS);
            } catch (PDOException $e) {
                throw new DatabaseConnectionException("An error occurred: " . $e->getCode() . " - " . $e->getMessage(), $e->getCode(), $e);
            }
        }

        return self::$instance;
    }
}
