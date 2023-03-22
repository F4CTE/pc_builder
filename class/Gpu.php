<?php
class Gpu extends Part
{
    private int $boostClock;
    private int $vram;
    private int $memoryClock;
    private int $length;
    private array $powerSupply;
    private int $tdp;

    public function __construct(
        string $name,
        string $producer,
        int $boostClock,
        int $vram,
        int $memoryClock,
        int $length,
        array $powerSupply,
        ?int $tdp = null,
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

        $this->boostClock = $boostClock;
        $this->vram = $vram;
        $this->memoryClock = $memoryClock;
        $this->length = $length;
        $this->powerSupply = $powerSupply;
        $this->tdp = $tdp;
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