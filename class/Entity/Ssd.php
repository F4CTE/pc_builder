<?php

namespace App\Ssd;

use App\Parent\Part;

class Ssd extends Part
{
    private string $form;
    private string $protocol;
    private int $storage;
    private ?string $nand;
    private ?string $controller;

    public function __construct(
        string $name,
        string $producer,
        string $form,
        string $protocol,
        int $storage,
        ?string $controller = null,
        ?string $nand = null,
        ?string $mpn = null,
        ?int $ean = null,
        ?string $imageLink = null,
        ?int $id = null,
    ) {
        parent::__construct(
            $name,
            $producer,
            $mpn,
            $ean,
            $imageLink,
            $id,
        );

        $this->form = $form;
        $this->protocol = $protocol;
        $this->storage = $storage;
        $this->nand = $nand;
        $this->controller = $controller;
    }

    final protected function createPdo(): void
    {
        $this->pdo = new SsdPdo();
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

    public function getForm(): string
    {
        return $this->form;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getSize(): int
    {
        return $this->storage;
    }

    public function getNand(): ?string
    {
        return $this->nand;
    }

    public function getController(): ?string
    {
        return $this->controller;
    }
}
