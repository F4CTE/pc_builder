<?php
class CpuCooler extends Part {
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
            $mpn ?? null,
            $ean ?? null,
            $imageLink ?? parent::defaultImage,
            $id ?? null,
        );

        $this->sockets = $sockets;
        $this->height = $height;
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
