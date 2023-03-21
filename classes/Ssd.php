<?php
class Ssd extends part {
    private string $form;
    private string $protocol;
    private int $storage;
    private string $nand;
    private string $controller;

    public function __construct(
        string $name,
        string $imageLink,
        string $producer,
        string $mpn,
        int $ean,
        string $form,
        string $protocol,
        int $storage,
        string $nand,
        string $controller,
    ) {
    parent::__construct(
        $name,
        $imageLink,
        $producer,
        $mpn,
        $ean
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