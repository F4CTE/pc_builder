<?php
class Hdd extends Part
{
    private int $size;
    private int $rpm;

    public function __construct(
        string $name,
        string $producer,
        int $size,
        int $rpm,
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
