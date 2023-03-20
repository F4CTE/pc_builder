<?php
class Cpu extends Part
{
    private Float $baseClock;
    private Float $turboClock;
    private Int $cores;
    private Int $threads;
    private String $socket;
    private Int $tdp;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        Float $baseClock,
        Float $turboClock,
        Int $cores,
        Int $threads,
        String $socket,
        Int $tdp
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

    public function getBaseClock(): Float
    {
        return $this->baseClock;
    }

    public function getTurboClock(): Float
    {
        return $this->turboClock;
    }

    public function getCores(): Int
    {
        return $this->cores;
    }

    public function getThreads(): Int
    {
        return $this->threads;
    }

    public function getSocket(): String
    {
        return $this->socket;
    }

    public function getTdp(): Int
    {
        return $this->tdp;
    }
}
