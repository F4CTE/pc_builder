<?php

namespace App\Psu;

use App\Build\Build;
use App\Chassis\Chassis;
use App\Parent\PartPdo;

class PsuPdo extends PartPdo
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

    public function rowToObject(array|bool $row): Psu|bool
    {
        if (!$row){
            return $row;
        } else 
        return new Psu(
            $row['name'],
            $row['producer'],
            $row['power'],
            json_decode($row['connectics'], true),
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


    public function getCompatibilityQuery(Build $build): array
    {

        $chassis= $build->getPart('chassis');
        $gpus = $build->getPart('gpus');
        $conditions=[];
        if($chassis instanceof Chassis){
            $conditions[] = 'format = \''.$chassis->getPsuFormat().'\'';
        }

        if(count($gpus)  > 0){
            $min6Pin = 0;
            $min8Pin = 0;
            foreach($gpus as $gpu){
                $min6Pin += $gpu->getPowerSupply()['pin_6'];
                $min8Pin += $gpu->getPowerSupply()['pin_8'];
            }
            $conditions[] = 'JSON_EXTRACT(connectics, \'$.pin_6\') >= \''.$min6Pin.'\'';
            $conditions[] = 'JSON_EXTRACT(connectics, \'$.pin_8\') >= \''.$min8Pin.'\'';
        }

        return $conditions;


    }
}
