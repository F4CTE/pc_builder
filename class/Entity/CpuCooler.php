<?php

namespace App\CpuCooler;

use App\Parent\Part;
use JsonSerializable;

class CpuCooler extends Part implements JsonSerializable
{
    private array $sockets;
    private int $height;

    public function __construct(
        string $name,
        string $producer,
        int $height,
        array $sockets,
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

        $this->sockets = $sockets;
        $this->height = $height;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'producer' => $this->producer,
            'mpn' => $this->mpn,
            'ean' => $this->ean,
            'imageLink' => $this->imageLink,
            'sockets' => $this->sockets,
            'height' => $this->height,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new CpuCoolerPdo();
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

    public function getSockets(): array
    {
        return $this->sockets;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
