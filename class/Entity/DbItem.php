<?php

namespace App\Parent;

abstract class DbItem
{
    protected ?int $id;
    protected ?PdoDb $pdo;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
        $this->createPdo();
    }

    final public function getId(): int
    {
        return $this->id;
    }

    final public function save(): void
    {
        !is_null($this->id) ? $this->update() : $this->id = $this->insert();
    }

    final public function destroy(): void
    {
        $this->delete();
        unset($this->id);
    }

    abstract protected function createPdo(): void;

    abstract protected function delete(): bool;

    abstract protected function insert(): int;

    abstract protected function update(): bool;
}
