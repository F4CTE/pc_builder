<?php

namespace App\Psu;

use App\Parent\DbItem;
use App\Parent\PdoDb;

class PsuPdo extends PdoDb
{
    private const TABLE_NAME = 'psus';
    private const UPDATE_QUERY = "UPDATE psus SET name = :name, producer = :producer, power = :power, connectics = :connectics, format = :format, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO psus (name,producer,power,connectics,format,mpn,ean,imageLink) VALUES (:name,:producer,:power,:connectics,:format,:mpn,:ean,:imageLink)";
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    public function jsonToObject(array $arrayItem): Psu
    {
        $psu = new Psu(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['watt'],
            array("pin_8" => $arrayItem['pin_8'] ?? 0, "pin_6" => $arrayItem['pin_6'] ?? 0),
            $arrayItem['size'] ?? null,
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        $psu->save();
        return $psu;
    }

    public function rowToObject(array $row): DbItem
    {
        return new Psu(
            $row['name'],
            $row['producer'],
            $row['power'],
            json_decode($row['connectics']),
            $row['format'],
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
            ':power' => $item->getPower(),
            ':connectics' => json_encode($item->getConnectics()),
            ':format' => $item->getFormat(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

}
