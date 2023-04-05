<?php

namespace App\Chassis;

use App\Parent\Part;
use JsonSerializable;

class Chassis extends Part implements JsonSerializable
{
    private string $MbFormat;
    private string $psuFormat;
    private int $maxGpuSize;
    private int $MaxCpuCoolerHeight;

    public function __construct(
        string $name,
        string $producer,
        string $MbFormat,
        string $psuFormat,
        int $maxGpuSize,
        int $MaxCpuCoolerHeight,
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

        $this->MbFormat = $MbFormat;
        $this->psuFormat = $psuFormat;
        $this->maxGpuSize = $maxGpuSize;
        $this->MaxCpuCoolerHeight = $MaxCpuCoolerHeight;
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
            'MbFormat' => $this->MbFormat,
            'psuFormat' => $this->psuFormat,
            'maxGpuSize' => $this->maxGpuSize,
            'MaxCpuCoolerHeight' => $this->MaxCpuCoolerHeight,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new ChassisPdo();
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

    public function getMbFormat(): string
    {
        return $this->MbFormat;
    }

    public function getPsuFormat(): string
    {
        return $this->psuFormat;
    }

    public function getMaxGpuSize(): int
    {
        return $this->maxGpuSize;
    }

    public function getMaxCpuCoolerHeight(): int
    {
        return $this->MaxCpuCoolerHeight;
    }
}
