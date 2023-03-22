<?php
class Mb extends Part
{
        private string $socket;
        private string $chipset;
        private string $form;
        private string $memoryType;
        private int $memoryCapacity;
        private array $ports = [
                'ram'=>'',
                'sata'=>'', 
                'm2Pcie3'=>'', 
                'm2Pcie4'=>'', 
                'pcie3X1'=>'', 
                'pcie3X16'=>'', 
                'pcie4X1'=>'', 
                'pcie4X16'=>'',
        ];

        public function __construct(
                string $name,
                string $producer,
                string $socket,
                string $chipset,
                string $form,
                string $memoryType,
                int $memoryCapacity,
                array $ports,
                ?string $mpn = null,
                ?int $ean = null,
                ?string $imageLink = parent::defaultImage,
                ?int $id = NULL,
        ) {
                parent::__construct(
                        $name,
                        $producer,
                        $mpn ?? null,
                        $ean ?? null,
                        $imageLink ?? parent::defaultImage,
                        $id ?? null,
                );

                $this->socket = $socket;
                $this->chipset = $chipset;
                $this->form  = $form;
                $this->memoryType =  $memoryType;
                $this->memoryCapacity = $memoryCapacity;
                $this->ports = $ports;
        }

        public function getPorts(): array
        {
                return $this->ports;
        }

        public function getPcie4X16(): int
        {
                return $this->ports['pcie4X16'];
        }

        public function getPcie4X1(): int
        {
                return $this->ports['pcie4X1'];
        }

        public function getPcie3X16(): int
        {
                return $this->ports['pcie3X16'];
        }

        public function getPcie3X1(): int
        {
                return $this->ports['pcie3X1'];
        }

        public function getM2Pcie4(): int
        {
                return $this->ports['m2Pcie4'];
        }

        public function getM2Pcie3(): int
        {
                return $this->ports['m2Pcie3'];
        }

        public function getSata(): int
        {
                return $this->ports['sata'];
        }

        public function getRam(): int
        {
                return $this->ports['ram'];
        }
        
        public function getMemoryCapacity(): int
        {
                return $this->memoryCapacity;
        }

        public function getMemoryType(): string
        {
                return $this->memoryType;
        }

        public function getForm(): string
        {
                return $this->form;
        }

        public function getChipset(): string
        {
                return $this->chipset;
        }

        public function getSocket(): string
        {
                return $this->socket;
        }
}
