<?php

namespace App\Parent;

use PDO;

abstract class PdoDb
{
    protected ?PDO $pdo = null;
    protected ?string $table = null;
    private string $updateQuery ;
    private string $insertQuery ;

    public function __construct(string $table, string $updateQuery, string $insertQuery)
    {
        $this->table = $table;
        $this->pdo = SinglePdo::getInstance();
        $this->updateQuery = $updateQuery;
        $this->insertQuery = $insertQuery;
    }

    final public function import($path)
    {
        $filecontents = file_get_contents($path);
        $elements = json_decode($filecontents, true);
        foreach ($elements as $element) {
            $this->jsonToObject($element);
        }
    }

    protected function jsonToObject(array $element): ?DbItem
    {
        return null;
    }

    final public function getAll(): array
    {
        $sql = 'SELECT * FROM ' . $this->table;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $objects = [];
        foreach ($result as $row) {
            $objects[] = $this->rowToObject($row);
        }
        return $objects;
    }

    final public function getById(int $id): ?dbitem
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $this->rowToObject($row);
    }

    final public function getByIds(array $Ids): array
    {
        $objects = [];
        foreach ($Ids as $id) {
            $objects[] = $this->getById($id);
        }
        return $objects;
    }

    abstract public function rowToObject(array|bool $row): DbItem|bool;

    abstract public function objectToRow(DbItem $item): array;

    final public function create($item): ?int
    {        
        $stmt = $this->pdo->prepare($this->insertQuery);
        $stmt->execute($this->objectToRow($item));
        return $this->pdo->lastInsertId();
    }

    final public function update($item): ?bool
    {
        $stmt = $this->pdo->prepare($this->updateQuery);
        $stmt->execute($this->objectToRow($item)+[':id' => $item->getId()]);
        return $stmt->rowCount() > 0;
    }


    final public function delete(DbItem $item): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->execute([
            ':id' => $item->getId()
        ]);
        return $stmt->rowCount() > 0;
    }

    final public function deleteAll(): ?bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM ". $this->table);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
