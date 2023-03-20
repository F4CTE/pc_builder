<?php
class Hdd extends Part
{
    private Int $size;
    private Int $rpm;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        Int $size,
        Int $rpm
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->size = $size;
        $this->rpm = $rpm;
    }

    public function getRpm(): Int
    {
        return $this->rpm;
    }

    public function getSize(): Int
    {
        return $this->size;
    }
}
