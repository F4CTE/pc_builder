<?php
class Ram extends Part
{
    private string $type;
    private int $capacity;
    private int $clock;
    private int $nbStick;

    public function __construct(
        string $name,
        string $producer,
        string $type,
        int $capacity,
        int $clock,
        int $nbStick,
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

        $this->type = $type;
        $this->capacity = $capacity;
        $this->clock = $clock;
        $this->nbStick = $nbStick;
    }

    
    public function getNbStick(): int
    {
        return $this->nbStick;
    }

    public function getClock(): int
    {
        return $this->clock;
    }


    public function getSize(): int
    {
        return $this->capacity;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
