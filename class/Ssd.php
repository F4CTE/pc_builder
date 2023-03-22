<?php
class Ssd extends part {
    private string $form;
    private string $protocol;
    private int $storage;
    private string $nand;
    private string $controller;

    public function __construct(
        string $name,
        string $producer,
        string $form,
        string $protocol,
        int $storage,
        string $nand,
        string $controller,
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

    $this->form = $form;
    $this->protocol = $protocol;
    $this->storage = $storage;
    $this->nand = $nand;
    $this->controller = $controller;

    }

    public function getForm(): string
    {
        return $this->form;
    }

    public function getProtocol(): string
    {
        return $this->protocol;
    }

    public function getSize(): int
    {
        return $this->storage;
    }

    public function getNand(): string
    {
        return $this->nand;
    }

    public function getController(): string
    {
        return $this->controller;
    }
}