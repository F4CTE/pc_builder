<?php

namespace App\Ram;

use PDO;
use App\Build\Build;
use App\Mb\Mb;
use App\Parent\PartPdo;

class RamPdo extends PartPdo
{
    private const TABLE_NAME = 'rams';
    private const UPDATE_QUERY = "UPDATE rams SET name = :name, producer = :producer, Type = :Type, capacity = :capacity, clock = :clock, sticks = :sticks, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO rams (name,producer,Type,capacity,clock,sticks,mpn,ean,imageLink) VALUES (:name,:producer,:Type,:capacity,:clock,:sticks,:mpn,:ean,:imageLink)";


    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }


    public function jsonToObject(array $arrayItem): ram
    {
        $ram = new Ram(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['RAM_TYPE'],
            intval($arrayItem['size']),
            $arrayItem['clock'],
            $arrayItem['sticks'],
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['image_url'] ?? null,
            null
        );

        $ram->save();
        return $ram;
    }

    public function rowToObject(array|bool $row): Ram|bool
    {
        if (!$row) {
            return $row;
        } else
            return new Ram(
                $row['name'],
                $row['producer'],
                $row['type'],
                $row['capacity'],
                $row['clock'],
                $row['sticks'],
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                $row['id']
            );
    }

    public function objectToRow($item): array
    {
        return [
            'name' => $item->getName(),
            'producer' => $item->getProducer(),
            'type' => $item->getType(),
            'capacity' => $item->getCapacity(),
            'clock' => $item->getClock(),
            'sticks' => $item->getSticks(),
            'mpn' => $item->getMpn(),
            'ean' => $item->getEan(),
            'imageLink' => $item->getImageLink()
        ];
    }

    public function getCompatibilityQuery(?Build $build): ?array
    {
    
        $motherboard = $build->getPart('motherboard');
        $conditions = [];
    
        if ($motherboard instanceof Mb) {
            $memType = $motherboard->getMemoryType();
            $conditions[] = "Type LIKE '" . $memType . "'";
        }
        
        return $conditions;
    }
}
