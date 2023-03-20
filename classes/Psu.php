<?php
class Psu extends Part
{
    private Int $power;
    private String $format;
    private String $efficiency;
    private Int $sixPin;
    private Int $eightPin;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        Int $power,
        String $format,
        String $efficiency,
        Int $sixPin = 0,
        Int $eightPin = 0
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->power = $power;
        $this->format = $format;
        $this->efficiency = $efficiency;
        $this->sixPin = $sixPin;
        $this->eightPin = $eightPin;
    }

    public function getEightPin(): Int
    {
        return $this->eightPin;
    }

    public function getSixPin(): Int
    {
        return $this->sixPin;
    }

    public function getEfficiency(): String
    {
        return $this->efficiency;
    }

    public function getFormat(): String
    {
        return $this->format;
    }

    public function getPower(): Int
    {
        return $this->power;
    }
}
