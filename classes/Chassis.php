<?php
class Chassis extends part {
    private string $MbFormat;
    private string $psuFormat;
    private int $maxGpuSize;
    private int $MaxCpuCoolerHeight;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        string$MbFormat,
        string $psuFormat,
        int $maxGpuSize,
        int $MaxCpuCoolerHeight,
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
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