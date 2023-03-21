<?php
class Cpu extends Part
{
    private float $baseClock;
    private float $turboClock;
    private int $cores;
    private int $threads;
    private string $socket;
    private int $tdp;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        float $baseClock,
        float $turboClock,
        int $cores,
        int $threads,
        string $socket,
        int $tdp
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->baseClock = $baseClock;
        $this->turboClock = $turboClock;
        $this->cores = $cores;
        $this->threads = $threads;
        $this->socket = $socket;
        $this->tdp = $tdp;
    }

    public function getBaseClock(): float
    {
        return $this->baseClock;
    }

    public function getTurboClock(): float
    {
        return $this->turboClock;
    }

    public function getCores(): int
    {
        return $this->cores;
    }

    public function getThreads(): int
    {
        return $this->threads;
    }

    public function getSocket(): string
    {
        return $this->socket;
    }

    public function getTdp(): int
    {
        return $this->tdp;
    }
}
