<?php

namespace App\Mb;

use App\Parent\Part;
use JsonSerializable;

class Mb extends Part implements JsonSerializable
{
        private string $socket;
        private string $chipset;
        private string $form;
        private string $memoryType;
        private ?int $memoryCapacity;
        private array $ports = [
                'ram' => '',
                'sata' => '',
                'm2Pcie3' => '',
                'm2Pcie4' => '',
                'pcie3X1' => '',
                'pcie3X16' => '',
                'pcie4X1' => '',
                'pcie4X16' => '',
        ];

        public function __construct(
                string $name,
                string $producer,
                string $socket,
                string $chipset,
                string $form,
                string $memoryType,
                array $ports,
                ?int $memoryCapacity = null,
                ?string $mpn = null,
                ?int $ean = null,
                ?string $imageLink = null,
                ?int $id = null,
        ) {
                parent::__construct(
                        $name,
                        $producer,
                        $mpn,
                        $ean,
                        $imageLink,
                        $id,
                );

                $this->socket = $socket;
                $this->chipset = $chipset;
                $this->form  = $form;
                $this->memoryType =  $memoryType;
                $this->memoryCapacity = $memoryCapacity;
                $this->ports = $ports;
        }

        public function jsonSerialize(): array
        {
                return [
                        'id' => $this->id,
                        'name' => $this->name,
                        'producer' => $this->producer,
                        'mpn' => $this->mpn,
                        'ean' => $this->ean,
                        'imageLink' => $this->imageLink,
                        'socket' => $this->socket,
                        'chipset' => $this->chipset,
                        'form' => $this->form,
                        'memoryType' => $this->memoryType,
                        'memoryCapacity' => $this->memoryCapacity,
                        'ports' => $this->ports,
                ];
        }

        protected function createPdo(): void
        {
                $this->pdo = new MbPdo();
        }

        protected function insert(): int
        {
                return $this->pdo->create($this);
        }

        protected function update(): bool
        {
                return $this->pdo->update($this);
        }

        protected function delete(): bool
        {
                return $this->pdo->delete($this);
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

        public function getm2Count()
        {
                return $this->getM2Pcie3() + $this->getM2Pcie4();
        }

        public function getSata(): int
        {
                return $this->ports['sata'];
        }

        public function getRam(): int
        {
                return $this->ports['ram'];
        }

        public function getMemoryCapacity(): ?int
        {
                return $this->memoryCapacity;
        }

        public function getMemoryType(): string
        {
                return $this->memoryType;
        }

        public function setForm(string $format)
        {
                $this->form = $format;
                return $this;
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
