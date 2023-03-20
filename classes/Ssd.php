<?php
class Ssd extends part {
    private String $form;
    private String $protocol;
    private Int $size;
    private String $nand;
    private String $controller;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        String $form,
        String $protocol,
        Int $size,
        String $nand,
        String $controller,
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
    $this->size = $size;
    $this->nand = $nand;
    $this->controller = $controller;

    }

    public function getForm(): String
    {
        return $this->form;
    }

    public function getProtocol(): String
    {
        return $this->protocol;
    }

    public function getSize(): Int
    {
        return $this->size;
    }

    public function getNand(): String
    {
        return $this->nand;
    }

    public function getController(): String
    {
        return $this->controller;
    }
}