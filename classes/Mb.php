<?php
class Mb extends Part {
    private String $socket;
    private String $chipset;
    private String $form;
    private String $memoryType;
    private Int $memoryCapacity;
    private Int $sata;
    private Int $m2Pcie3;
    private Int $m2Pcie4;
    private Int $usb3Slots;
    private Int $usbC;
    private Int $usb3Headers;
    private Int $vga;
    private Int $dvi;
    private Int $displayPort;
    private Int $hdmi;
    private Int $pcie3X1;
    private Int $pcie3X16;
    private Int $pcie4X1;
    private Int $pcie4X16;

    public function __construct(
        String $name,
        String $imageLink,
        String $producer,
        String $mpn,
        Int $ean,
        String $socket,
        String $chipset,
        String $form,
        String $memoryType,
        Int $memoryCapacity,
        Int $sata,
        Int $m2Pcie3,
        Int $m2Pcie4,
        Int $usb3Slots,
        Int $usbC,
        Int $usb3Headers,
        Int $vga,
        Int $dvi,
        Int $displayPort,
        Int $hdmi,
        Int $pcie3X1,
        Int $pcie3X16,
        Int $pcie4X1,
        Int $pcie4X16,
    ) {
        parent::__construct(
            $name,
            $imageLink,
            $producer,
            $mpn,
            $ean
        );
        
        $this->socket = $socket;
        $this->chipset = $chipset;
        $this->form  = $form;
        $this->memoryType =  $memoryType;
        $this->memoryCapacity = $memoryCapacity;
        $this->sata = $sata;
        $this->m2Pcie3 = $m2Pcie3;
        $this->m2Pcie4 = $m2Pcie4;
        $this->usb3Slots = $usb3Slots;
        $this->usbC =  $usbC;
        $this->usb3Headers = $usb3Headers;
        $this->vga = $vga;
        $this->dvi = $dvi;
        $this->displayPort = $displayPort;
        $this->hdmi = $hdmi;
        $this->pcie3X1 = $pcie3X1;
        $this->pcie3X16 = $pcie3X16;
        $this->pcie4X1 = $pcie4X1;
        $this->pcie4X16 = $pcie4X16;
    }

        public function getPcie4X16(): Int
        {
                return $this->pcie4X16;
        }

        public function getPcie4X1(): Int
        {
                return $this->pcie4X1;
        }


        public function getPcie3X16(): Int
        {
                return $this->pcie3X16;
        }

        public function getPcie3X1(): Int
        {
                return $this->pcie3X1;
        }

        public function getHdmi(): Int
        {
                return $this->hdmi;
        }

        public function getDisplayPort(): Int
        {
                return $this->displayPort;
        }

        public function getDvi(): Int
        {
                return $this->dvi;
        }

        public function getVga(): Int
        {
                return $this->vga;
        }

        public function getUsb3Headers(): Int
        {
                return $this->usb3Headers;
        }

        public function getUsbC(): Int
        {
                return $this->usbC;
        }

        public function getUsb3Slots(): Int
        {
                return $this->usb3Slots;
        }

        public function getM2Pcie4(): Int
        {
                return $this->m2Pcie4;
        }

        public function getM2Pcie3(): Int
        {
                return $this->m2Pcie3;
        }

        public function getSata(): Int
        {
                return $this->sata;
        }

        public function getMemoryCapacity(): Int
        {
                return $this->memoryCapacity;
        }

        public function getMemoryType(): String
        {
                return $this->memoryType;
        }

        public function getForm(): String
        {
                return $this->form;
        }

        public function getChipset(): String
        {
                return $this->chipset;
        }

        public function getSocket(): String
        {
                return $this->socket;
        }
}