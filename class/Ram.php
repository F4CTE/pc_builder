<?php
namespace App;
class Ram extends Part
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
        ?string $imageLink = parent::defaultImage,
        ?int $id = null,
    ) {
        parent::__construct(
            $name,
            $producer,
            $mpn,
            $ean,
            $imageLink ?? parent::defaultImage,
            $id,
        );

        $this->type = $type;
        $this->capacity = $capacity;
        $this->clock = $clock;
        $this->nbStick = $nbStick;
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

    public function getNbStick(): int
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
