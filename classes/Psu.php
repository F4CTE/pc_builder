<?php
class Psu extends Part
{
    private int $power;
    private string $format;
    private array $connectics;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        int $power,
        string $format,
        array $connectics,
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
        $this->connectics = $connectics;
    }

    public function getConnectics(): array
    {
        return $this->connectics;
    }

    public function getEightPin(): int
    {
        return $this->connectics['eightPin'];
    }

    public function getSixPin(): int
    {
        return $this->connectics['sixPin'];
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getPower(): int
    {
        return $this->power;
    }
}
