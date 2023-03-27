<?php

namespace App\Parent;

abstract class Part extends DbItem
{
    protected string $name;
    protected string $imageLink;
    protected string $producer;
    protected ?string $mpn;
    protected ?int $ean;
    const DEFAULT_IMAGE = "https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png";

    public function __construct(
        string $name,
        string $producer,
        ?string $mpn = null,
        ?int $ean = null,
        ?string $imageLink = null,
        ?int $id = null,
    ) {
        parent::__construct($id);
        $this->name = $name;
        $this->producer = $producer;
        $this->mpn = $mpn;
        $this->ean = $ean;
        $this->imageLink = $imageLink ?? self::DEFAULT_IMAGE;
    }

    final public function getName(): string
    {
        return $this->name;
    }

    final public function getImageLink(): string
    {
        return $this->imageLink;
    }

    final public function getProducer(): string
    {
        return $this->producer;
    }

    final public function getMpn(): ?string
    {
        return $this->mpn;
    }

    final public function getEan(): string
    {
        return $this->ean;
    }
}
