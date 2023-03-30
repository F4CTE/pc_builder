<?php

namespace App\CpuCooler;

use App\Parent\DbItem;
use App\Parent\PdoDb;

class CpuCoolerPdo extends PdoDb
{
    private const TABLE_NAME = 'cpu_cooler';
    private const INSERT_QUERY = "INSERT INTO cpu_cooler (name, producer, height, sockets, mpn, ean, imageLink) VALUES (:name, :producer, :height, :sockets, :mpn, :ean, :imageLink)";
    private const UPDATE_QUERY = "UPDATE cpu_cooler SET name = :name, producer = :producer, height = :height, sockets = :sockets, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";


    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    protected function jsonToObject(array $arrayItem): CpuCooler
    {
        $cpuCooler = new CpuCooler(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['Height']),
            explode(', ', $arrayItem['sockets']),
            $arrayItem['mpn'] ?? null,
            $arrayItem['ean'] ?? null,
            $arrayItem['image_url'] ?? null,
            null
        );
        return $cpuCooler;
    }

    public function rowToObject(array|bool $row): CpuCooler|bool
    {
        if (!$row){
            return $row;
        } else 
        return new CpuCooler(
            $row['name'],
            $row['producer'],
            $row['height'],
            json_decode($row['sockets'], true),
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
            ':height' => $item->getHeight(),
            ':sockets' => json_encode($item->getSockets()),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

}
