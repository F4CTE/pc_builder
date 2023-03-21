<?php
class Part {
    private string $name;
    private string $imageLink;
    private string $producer;
    private string $mpn;
    private int $ean;
    const defaultImage = "https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png";

    public function __construct(
        string $name, 
        string $imageLink = self::defaultImage , 
        string $producer, 
        string $mpn, 
        int $ean
    ) {
        $this->name = $name;
        $this->imageLink = $imageLink;
        $this->producer = $producer;
        $this->mpn = $mpn;
        $this->ean = $ean;
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