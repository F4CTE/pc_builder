<?php
class Chassis extends part {
    private string $MbFormat;
    private string $psuFormat;
    private int $maxGpuSize;
    private int $MaxCpuCoolerHeight;

    public function __construct(
        string $name,
        string $producer,
        string$MbFormat,
        string $psuFormat,
        int $maxGpuSize,
        int $MaxCpuCoolerHeight,
        ?string $mpn = null,
        ?int $ean = null,
        ?string $imageLink = parent::defaultImage,
        ?int $id = null,
    ) {
        parent::__construct(
            $name,
            $producer,
            $mpn ?? null,
            $ean ?? null,
            $imageLink ?? parent::defaultImage,
            $id ?? null,
        );

        $this->MbFormat = $MbFormat;
        $this->psuFormat = $psuFormat;
        $this->maxGpuSize = $maxGpuSize;
        $this->MaxCpuCoolerHeight = $MaxCpuCoolerHeight;
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