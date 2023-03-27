<?php

namespace App\Parent;

use PDO;

abstract class PdoDb
{
    protected ?PDO $pdo = null;

    final public function __construct()
    {
        $this->pdo = SinglePdo::getInstance();
    }

    final public function import($path)
    {
        $filecontents = file_get_contents($path);
        $elements = json_decode($filecontents, true);
        foreach ($elements as $element) {
            $this->createDbItem($element);
        }
    }

    protected function createDbItem(array $element): ?DbItem
    {
        return null;
    }

    abstract public function getById(int $id): ?DbItem;

    abstract public function getAll(): array;

    abstract public function create($item): ?int;

    abstract public function update($item): ?bool;

    abstract public function delete($item): ?bool;

    abstract public function deleteAll(): ?bool;
}
