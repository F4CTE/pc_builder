<?php

namespace App\Gpu;

use App\Parent\Part;
use JsonSerializable;

class Gpu extends Part implements JsonSerializable
{
    private int $boostClock;
    private int $vram;
    private int $memoryClock;
    private int $length;
    private ?array $powerSupply;
    private int $tdp;

    public function __construct(
        string $name,
        string $producer,
        int $boostClock,
        int $vram,
        int $memoryClock,
        int $length,
        ?array $powerSupply,
        ?int $tdp = null,
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

        $this->boostClock = $boostClock;
        $this->vram = $vram;
        $this->memoryClock = $memoryClock;
        $this->length = $length;
        $this->powerSupply = $powerSupply;
        $this->tdp = $tdp;
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
            'boostClock' => $this->boostClock,
            'vram' => $this->vram,
            'memoryClock' => $this->memoryClock,
            'length' => $this->length,
            'powerSupply' => $this->powerSupply,
            'tdp' => $this->tdp,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new GpuPdo();
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

    public function getTdp(): int
    {
        return $this->tdp;
    }

    public function getPowerSupply(): array
    {
        return $this->powerSupply;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function getMemoryClock(): int
    {
        return $this->memoryClock;
    }

    public function getVram(): int
    {
        return $this->vram;
    }

    public function getBoostClock(): int
    {
        return $this->boostClock;
    }
}
