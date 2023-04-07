<?php

namespace App\Psu;

use App\Parent\Part;
use JsonSerializable;

class Psu extends Part implements JsonSerializable
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
        ?string $imageLink = null,
        ?int $id = null,
    ) {
        parent::__construct(
            $name,
            $producer,
            $mpn,
            $ean,
            $imageLink,
            $id,
        );

        $this->power = $power;
        $this->format = $format;
        $this->connectics = $connectics;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'producer' => $this->producer,
            'mpn' => $this->mpn,
            'ean' => $this->ean,
            'imageLink' => $this->imageLink,
            'power' => $this->power,
            'format' => $this->format,
            'connectics' => $this->connectics,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new PsuPdo();
    }

    protected function insert(): int
    {
        return $this->pdo->create($this);
    }

    protected function update(): bool
    {
        return $this->pdo->update($this);
    }

    protected function delete(): bool
    {
        return $this->pdo->delete($this);
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

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function getPower(): int
    {
        return $this->power;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }
}
