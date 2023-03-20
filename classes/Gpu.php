<?php
class Gpu extends Part
{
    private Int $boostClock;
    private Int $vram;
    private Int $memoryClock;
    private Int $length;
    private Float $slot;
    private array $powerSupply;
    private array $outputs;
    private Int $tdp;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        Int $boostClock,
        Int $vram,
        Int $memoryClock,
        Int $length,
        Float $slot,
        array $powerSupply,
        array $outputs,
        Int $tdp
    ) {

        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->boostClock = $boostClock;
        $this->vram = $vram;
        $this->memoryClock = $memoryClock;
        $this->length = $length;
        $this->slot = $slot;
        $this->powerSupply = $powerSupply;
        $this->outputs = $outputs;
        $this->tdp = $tdp;
    }



    public function getTdp(): Int
    {
        return $this->tdp;
    }

    public function getOutputs(): array
    {
        return $this->outputs;
    }

    public function getPowerSupply(): array
    {
        return $this->powerSupply;
    }

    public function getSlot(): Float
    {
        return $this->slot;
    }

    public function getLength(): Int
    {
        return $this->length;
    }

    public function getMemoryClock(): Int
    {
        return $this->memoryClock;
    }

    public function getVram(): Int
    {
        return $this->vram;
    }

    public function getBoostClock(): Int
    {
        return $this->boostClock;
    }
}
