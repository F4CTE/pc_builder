<?php

namespace App\Hdd;

use App\Parent\Part;
use JsonSerializable;

class Hdd extends Part implements JsonSerializable
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

        $this->size = $size;
        $this->rpm = $rpm;
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
            'size' => $this->size,
            'rpm' => $this->rpm,
        ];
    }

    protected function createPdo(): void
    {
        $this->pdo = new HddPdo();
    }

    protected function insert(): int
    {
        return (new HddPdo())->create($this);
    }

    protected function update(): bool
    {
        return (new HddPdo())->update($this);
    }

    protected function delete(): bool
    {
        return (new HddPdo())->delete($this);
    }

    public function getRpm(): int
    {
        return $this->rpm;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setRpm(int $rpm)
    {
        $this->rpm = $rpm;
        return $this;
    }
}
