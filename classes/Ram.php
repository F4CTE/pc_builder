<?php
class Ram extends Part
{
    private string $type;
    private int $size;
    private int $clock;
    private int $nbStick;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        string $type,
        int $size,
        int $clock,
        int $nbStick,
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->type = $type;
        $this->size = $size;
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
        return $this->size;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
