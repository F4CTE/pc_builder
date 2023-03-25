<?php

namespace App\Build;

use App\Parent\DbItem;

class build extends DbItem
{
    private int $userId;
    private string $name;
    private array $parts = [
        'cpu' => null,
        'cpuCooler' => null,
        'motherboard' => null,
        'rams' => [],
        'gpus' => [],
        'psu' => null,
        'case' => null,
        'hdds' => [],
        'ssds' => [],
    ];

    public function __construct(
        int $userId,
        string $name,
        array $parts,
        ?int $id = NULL,
    ) {
        parent::__construct($id);
        $this->userId = $userId;
        $this->name = $name;
        $this->parts = $parts;
    }

    protected function createPdo(): void
    {
        $this->pdo = new BuildPdo();
    }

    protected function insert(): int
    {
        return $this->pdo->create($this);
    }

    protected function update(): bool
    {
        return $this->pdo->update($this);
    }

    protected function delete(): bool
    {
        return $this->pdo->delete($this);
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParts(): array
    {
        return $this->parts;
    }
}
