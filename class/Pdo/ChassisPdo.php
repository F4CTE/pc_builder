<?php

namespace App\Chassis;

use App\Parent\DbItem;
use App\Parent\PdoDb;

class ChassisPdo extends PdoDb
{
    private const TABLE_NAME = 'chassis';
    private const UPDATE_QUERY = 'UPDATE chassis SET name = :name, producer = :producer, mbFormat = :mbFormat, psuFormat = :psuFormat, maxGpuSize = :maxGpuSize, maxCpuCoolerHeight = :maxCpuCoolerHeight, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id';
    private const INSERT_QUERY = 'INSERT INTO chassis (name, producer, mbFormat, psuFormat, maxGpuSize, maxCpuCoolerHeight, mpn, ean, imageLink) VALUES (:name, :producer, :mbFormat, :psuFormat, :maxGpuSize, :maxCpuCoolerHeight, :mpn, :ean, :imageLink)';
    
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    protected function jsonToObject(array $arrayItem): ?Chassis
    {
        $chassis = new Chassis(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['Motherboard'],
            $arrayItem['Psu'] ?? $arrayItem['Motherboard'],
            intval($arrayItem['gpu_size']),
            intval($arrayItem['cpu_cooler_height']),
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        return $chassis;
    }


    public function objectToRow($item): array
    {
        return [
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':mbFormat' => $item->getMbFormat(),
            ':psuFormat' => $item->getPsuFormat() ?? $item->getMbFormat(),
            ':maxGpuSize' => $item->getMaxGpuSize(),
            ':maxCpuCoolerHeight' => $item->getMaxCpuCoolerHeight(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

    public function rowToObject($row): Chassis
    {
        return new Chassis(
            $row['name'],
            $row['producer'],
            $row['mbFormat'],
            $row['psuFormat'] ?? $row['mbFormat'],
            $row['maxGpuSize'],
            $row['maxCpuCoolerHeight'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

}
