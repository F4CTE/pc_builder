<?php

namespace App\Gpu;

use App\Parent\DbItem;
use App\Parent\PdoDb;

class GpuPdo extends PdoDb
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


    public function rowToObject(array $row): DbItem
    {
        return new Gpu(
            $row['name'],
            $row['producer'],
            $row['boostClock'],
            $row['vram'],
            $row['memoryClock'],
            $row['length'],
            json_decode($row['powerSupply']),
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

}
