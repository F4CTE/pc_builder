<?php

namespace App\CpuCooler;

use App\Build\build;
use App\Chassis\Chassis;
use App\Mb\Mb;
use App\Parent\PartPdo;


class CpuCoolerPdo extends PartPdo
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
        if (!$row) {
            return $row;
        } else
            return new CpuCooler(
                $row['name'],
                $row['producer'],
                $row['height'],
                is_array($row['sockets']) ? $row['sockets'] : json_decode($row['sockets']),
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

    protected function getCompatibilityQuery(Build $build): ?array
    {
        $conditions = [];

        $mb = $build->getPart('motherboard');
        $chassis = $build->getPart('chassis');

        if ($mb instanceof Mb) {
            $conditions[] = "sockets LIKE '%\"" . $mb->getSocket() . "\"%'";
        }
        if ($chassis instanceof Chassis) {
            $conditions[] = "height <= " . $chassis->getMaxCpuCoolerHeight();
        }

        return $conditions;
    }
}
