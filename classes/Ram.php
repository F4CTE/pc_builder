<?php
class Ram extends Part
{
    private String $type;
    private Int $size;
    private Int $clock;
    private String $timings;
    private Int $nbStick;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        String $type,
        Int $size,
        Int $clock,
        String $timings,
        Int $nbStick,
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
        $this->timings = $timings;
        $this->nbStick = $nbStick;
    }

    
    public function getNbStick(): Int
    {
        return $this->nbStick;
    }

    public function getTimings(): String
    {
        return $this->timings;
    }

    public function getClock(): Int
    {
        return $this->clock;
    }


    public function getSize(): Int
    {
        return $this->size;
    }

    public function getType(): String
    {
        return $this->type;
    }
}
