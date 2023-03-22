<?php

require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

class ImportJsonToDb {
    private pdo $pdo;
    private string $dsn;
    const options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    public function __construct()
    {
        $this->dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'];
        try {
            $this->pdo = new PDO($this->dsn, $_ENV['user'], $_ENV['password'], $this::options);
        } catch (PDOException $e) {
            die('Une erreur est survenue : ' . $e->getCode() . '-' . $e->getMessage());
        };
    }
    

}