<?php
namespace App;
class CpuCooler extends Part
{
    private array $sockets;
    private int $height;

    public function __construct(
        string $name,
        string $producer,
        int $height,
        array $sockets,
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

        $this->sockets = $sockets;
        $this->height = $height;
    }

    protected function createPdo(): void
    {
        $this->pdo = new CpuCoolerPdo();
    }

    protected function insert(): int
    {
        return $this->pdo->create($this);
    }

    protected function update(): bool
    {
        return $this->pdo->update($this);
    }

    protected function delete(): bool{
        return $this->pdo->delete($this);
    }

    public function getSockets(): array
    {
        return $this->sockets;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
