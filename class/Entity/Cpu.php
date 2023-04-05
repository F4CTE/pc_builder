<?php

namespace App\Cpu;

use App\Parent\Part;
use JsonSerializable;

class Cpu extends Part implements JsonSerializable
{
    private float $baseClock;
    private float $turboClock;
    private int $cores;
    private int $threads;
    private string $socket;
    private ?int $tdp;

    public function __construct(
        string $name,
        string $producer,
        float $baseClock,
        float $turboClock,
        int $cores,
        int $threads,
        string $socket,
        ?int $tdp = null,
        ?string $mpn = null,
        ?string $ean = null,
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

        $this->baseClock = $baseClock;
        $this->turboClock = $turboClock;
        $this->cores = $cores;
        $this->threads = $threads;
        $this->socket = $socket;
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
            'baseClock' => $this->baseClock,
            'turboClock' => $this->turboClock,
            'cores' => $this->cores,
            'threads' => $this->threads,
            'socket' => $this->socket,
            'tdp' => $this->tdp,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new CpuPdo();
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
