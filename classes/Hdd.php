<?php
class Hdd extends Part
{
    private int $size;
    private int $rpm;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        int $size,
        int $rpm
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

    public function getRpm(): int
    {
        return $this->rpm;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}
