<?php
class Chassis extends part {
    private Int $width;
    private Int $depth;
    private Int $height;
    private String $MbFormat;
    private String $psuFormat;
    private Int $maxGpuSize;
    private Int $MaxCpuCoolerHeight;
    private Float $fan80;
    private Float $fan120;
    private Float $fan140;
    private Float $fan200;
    private Int $rad120;
    private Int $rad240;
    private Int $rad280;
    private Int $rad360;
    private Int $disk25;
    private Int $disk35;
    private Int $disk2535;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        Int $width,
        Int $depth,
        Int $height,
        String$MbFormat,
        String $psuFormat,
        Int $maxGpuSize,
        Int $MaxCpuCoolerHeight,
        Int $fan80 = 0,
        Int $fan120 = 0,
        Int $fan140 = 0,
        Int $fan200 = 0,
        Int $rad120 = 0,
        Int $rad240 = 0,
        Int $rad280 = 0,
        Int $rad360 = 0,
        Int $disk25 = 0,
        Int $disk35 = 0,
        Int $disk2535 = 0,
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );

        $this->width = $width;
        $this->depth = $depth;
        $this->height = $height;
        $this->MbFormat = $MbFormat;
        $this->psuFormat = $psuFormat;
        $this->maxGpuSize = $maxGpuSize;
        $this->MaxCpuCoolerHeight = $MaxCpuCoolerHeight;
        $this->fan80 = $fan80;
        $this->fan120 = $fan120;
        $this->fan140 = $fan140;
        $this->fan200 = $fan200;
        $this->rad120 = $rad120;
        $this->rad240 = $rad240;
        $this->rad280 = $rad280;
        $this->rad360 = $rad360;
        $this->disk25 = $disk25;
        $this->disk35 = $disk35;
        $this->disk2535 = $disk2535;

    }

    public function getWidth(): Int
    {
        return $this->width;
    }

    public function getDepth(): Int
    {
        return $this->depth;
    }

    public function getHeight(): Int
    {
        return $this->height;
    }

    public function getMbFormat(): String
    {
        return $this->MbFormat;
    }

    public function getPsuFormat(): String
    {
        return $this->psuFormat;
    }

    public function getMaxGpuSize(): Int
    {
        return $this->maxGpuSize;
    }

    public function getMaxCpuCoolerHeight(): Int
    {
        return $this->MaxCpuCoolerHeight;
    }

    public function getFan80(): Float
    {
        return $this->fan80;
    }

    public function getFan120(): Float
    {
        return $this->fan120;
    }

    public function getFan140(): Float
    {
        return $this->fan140;
    }

    public function getFan200(): Float
    {
        return $this->fan200;
    }

    public function getRad120(): Int
    {
        return $this->rad120;
    }

    public function getRad240(): Int
    {
        return $this->rad240;
    }

    public function getRad280(): Int
    {
        return $this->rad280;
    }

    public function getRad360(): Int
    {
        return $this->rad360;
    }

    public function getDisk25(): Int
    {
        return $this->disk25;
    }

    public function getDisk35(): Int
    {
        return $this->disk35;
    }

    public function getDisk2535(): Int
    {
        return $this->disk2535;
    }
}