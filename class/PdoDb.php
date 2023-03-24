<?php

namespace App;

use PDO;
use PDOException;

abstract class PdoDb
{
    protected PDO $pdo;
    protected string $dsn;
    const options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    final public function __construct()
    {
        $this->dsn = 'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'];
        try {
            $this->pdo = new PDO($this->dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $this::options);
        } catch (PDOException $e) {
            die('Une erreur est survenue : ' . $e->getCode() . '-' . $e->getMessage());
        };
    }

    abstract public function getById(int $id): ?object;

    abstract public function getAll(): array;

    abstract public function create($item): ?int;

    abstract public function update($item): ?bool;

    abstract public function delete($item): ?bool;
}
