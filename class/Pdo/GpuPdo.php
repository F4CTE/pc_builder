<?php

namespace App\Gpu;

use App\Build\build;
use App\Chassis\Chassis;
use App\Mb\Mb;
use App\Parent\PartPdo;
use App\Psu\Psu;

class GpuPdo extends PartPdo
{
    private const TABLE_NAME = 'gpus';
    private const UPDATE_QUERY = "UPDATE gpus SET name = :name, producer = :producer, boostClock = :boostClock, vram = :vram, memoryClock = :memoryClock, length = :length, powerSupply = :powerSupply, tdp = :tdp, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO gpus (name, producer, boostClock, vram, memoryClock, length, powerSupply, tdp, mpn, ean, imageLink) VALUES (:name, :producer, :boostClock, :vram, :memoryClock, :length, :powerSupply, :tdp, :mpn, :ean, :imageLink)";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    public function jsonToObject(array $arrayItem): Gpu
    {
        $gpu = new Gpu(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['boost_clock']),
            intval($arrayItem['vram']),
            intval($arrayItem['memory_clock']),
            intval($arrayItem['length']),
            array("pin_8" => intval($arrayItem['pin_8']), "pin_6" => intval($arrayItem['pin_6'])),
            intval($arrayItem['TDP']),
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['image_url'] ?? null,
            null
        );

        return $gpu;
    }


    public function rowToObject(array|bool $row): Gpu|bool
    {
        if (!$row) {
            return $row;
        } else
            return new Gpu(
                $row['name'],
                $row['producer'],
                $row['boostClock'],
                $row['vram'],
                $row['memoryClock'],
                $row['length'],
                json_decode($row['powerSupply'], true),
                $row['tdp'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
    }

    public function objectToRow($item): array
    {
        return [
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':boostClock' => $item->getBoostClock(),
            ':vram' => $item->getVram(),
            ':memoryClock' => $item->getMemoryClock(),
            ':length' => $item->getLength(),
            ':powerSupply' => json_encode($item->getPowerSupply()),
            ':tdp' => $item->getTdp(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

    protected function getCompatibilityQuery(Build $build): ?array
    {
        $chassis = $build->getPart('chassis');
        $motherboard = $build->getPart('motherboard');
        $psu = $build->getPart('psu');
        $conditions = [];
    
        if ($motherboard instanceof Mb) {
            if ($motherboard->getPcie3X16() + $motherboard->getPcie4X16() < 1) {
                return null;
            }
        }
    
        if ($chassis instanceof Chassis) {
            $conditions[] = 'maxGpuSize >= ' . $chassis->getMaxGpuSize();
        }
    
        if ($psu instanceof Psu) {
            $conditions[] = 'JSON_EXTRACT(PowerSupply, \'$.pin_8\') <= \'' . $psu->getEightPin() . '\'';
            $conditions[] = 'JSON_EXTRACT(powerSupply, \'$.pin_6\') <= \'' . $psu->getSixPin() . '\'';
        }
    
        return $conditions;
    }
}
