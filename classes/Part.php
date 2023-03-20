<?php
class Part {
    private String $name;
    private String $imageLink;
    private String $producer;
    private String $mpn;
    private Int $ean;
    const defaultImage = "https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png";

    public function __construct(
        String $name, 
        String $imageLink = self::defaultImage , 
        String $producer, 
        String $mpn, 
        Int $ean
    ) {
        $this->name = $name;
        $this->imageLink = $imageLink;
        $this->producer = $producer;
        $this->mpn = $mpn;
        $this->ean = $ean;
    }
    
    public function getName(): String {
        return $this->name;
    }
    
    public function getImageLink(): String {
        return $this->imageLink;
    }
    
    public function getProducer(): String {
        return $this->producer;
    }

    public function getMpn():String {
        return $this->mpn;
    }
    
    public function getEan():String {
        return $this->ean;
    }
}