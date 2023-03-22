<?php
require_once __DIR__ . '/DbItem.php';
class Part extends DbItem{
    private string $name;
    private string $imageLink;
    private string $producer;
    private ?string $mpn;
    private ?int $ean;
    const defaultImage = "https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png";

    public function __construct(
        string $name,
        string $producer, 
        ?string $mpn = null, 
        ?int $ean = null,
        ?string $imageLink = self::defaultImage,
        ?int $id = null,
    ) {
        parent::__construct($id ?? null);
        $this->name = $name;
        $this->producer = $producer;
        $this->mpn = $mpn ?? null;
        $this->ean = $ean ?? null;
        $this->imageLink = $imageLink ?? self::defaultImage;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getImageLink(): string {
        return $this->imageLink;
    }
    
    public function getProducer(): string {
        return $this->producer;
    }

    public function getMpn():string {
        return $this->mpn;
    }
    
    public function getEan():string {
        return $this->ean;
    }
}