<?php
class CpuCooler extends Part
{
    private array $sockets;
    private int $height;
    private int $tdp;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        array $sockets,
        int $height,
        int $tdp,
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->sockets = $sockets;
        $this->height = $height;
        $this->tdp = $tdp;
    }

    public function getSockets(): array
    {
        return $this->sockets;
    }

    public function getTdp(): int
    {
        return $this->tdp;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
