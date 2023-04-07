<?php

namespace App\Hdd;

use App\Build\build;
use App\Mb\Mb;
use App\Parent\PartPdo;

class HddPdo extends PartPdo
{

    private const TABLE_NAME = 'hdds';
    private const UPDATE_QUERY = "UPDATE hdds SET name = :name, producer = :producer, capacity = :capacity, rpm = :rpm, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO hdds (name, producer, capacity, rpm, mpn, ean, imageLink) VALUES (:name, :producer, :capacity, :rpm, :mpn, :ean, :imageLink)";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }


    public function jsonToObject(array $arrayItem): Hdd
    {
        if ($arrayItem['producer'] == '3.5"' || $arrayItem['producer'] == '2.5"' || $arrayItem['producer'] == 'Link') {

            if (explode(' ', $arrayItem['name'])[0] == 'Western' || explode(' ', $arrayItem['name'])[0] == 'WD') {
                $arrayItem['producer'] = 'Western Digital';
            } else $arrayItem['producer'] = explode(' ', $arrayItem['name'])[0];
        }
        $hdd = new Hdd(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['size']) * 1000,
            intval($arrayItem['rpm']),
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        return $hdd;
    }

    public function objectToRow($item): array
    {
        return [
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':capacity' => $item->getSize(),
            ':rpm' => $item->getRpm(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

    public function rowToObject(array|bool $row): Hdd|bool
    {
        if (!$row) {
            return $row;
        } else
            return new Hdd(
                $row['name'],
                $row['producer'],
                $row['capacity'] ?? $row['size'],
                $row['rpm'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
    }

    protected function getCompatibilityQuery(Build $build): ?array
    {
        $motherboard = $build->getPart('motherboard');

        if ($motherboard instanceof Mb) {
            if ($motherboard->getSata() > 0) {
                return [];
            }
        }

        return null;
    }
}
