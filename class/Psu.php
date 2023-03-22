<?php
class Psu extends Part
{
    private int $power;
    private ?string $format;
    private array $connectics;

    public function __construct(
        string $name,
        string $producer,
        int $power,
        array $connectics,
        ?string $format = null,
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
        $this->format = $format ?? null;
        $this->connectics = $connectics;
    }

    public function getConnectics(): array
    {
        return $this->connectics;
    }

    public function getEightPin(): int
    {
        return $this->connectics['pin_8'];
    }

    public function getSixPin(): int
    {
        return $this->connectics['pin_6'];
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
