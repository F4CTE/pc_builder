<?php
class CpuCooler extends Part
{
    private $sockets;
    private $height;
    private $tdp;
    private $fans;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        array $sockets,
        Int $height,
        Int $tdp,
        array $fans,
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
        $this->fans = $fans;
    }

    public function getSockets(): array
    {
        return $this->sockets;
    }

    public function getFans(): array
    {
        return $this->fans;
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
