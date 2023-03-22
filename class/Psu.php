<?php
class Psu extends Part
{
    private int $power;
    private string $format;
    private array $connectics;

    public function __construct(
        string $name,
        string $producer,
        int $power,
        string $format,
        array $connectics,
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
