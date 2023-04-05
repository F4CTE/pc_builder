<?php

namespace App\Ram;

use App\Parent\Part;
use JsonSerializable;

class Ram extends Part implements JsonSerializable
{
    private string $type;
    private int $capacity;
    private int $clock;
    private int $nbStick;

    public function __construct(
        string $name,
        string $producer,
        string $type,
        int $capacity,
        int $clock,
        int $nbStick,
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

        $this->type = $type;
        $this->capacity = $capacity;
        $this->clock = $clock;
        $this->nbStick = $nbStick;
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
            'type' => $this->type,
            'capacity' => $this->capacity,
            'clock' => $this->clock,
            'nbStick' => $this->nbStick,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new RamPdo();
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

    public function getSticks(): int
    {
        return $this->nbStick;
    }

    public function getClock(): int
    {
        return $this->clock;
    }


    public function getSize(): int
    {
        return $this->capacity;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
