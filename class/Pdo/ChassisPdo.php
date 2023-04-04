<?php

namespace App\Chassis;

use App\Build\build;
use App\CpuCooler\CpuCooler;
use App\Mb\Mb;
use App\Parent\PartPdo;
use App\Psu\Psu;

class ChassisPdo extends PartPdo
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

    public function rowToObject(array|bool $row): Chassis|bool
    {
        if (!$row) {
            return $row;
        } else
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

    protected function getCompatibilityQuery(build $build): null|array
    {

        $conditions = [];

        $cpuCooler = $build->getPart('cpuCooler');
        if ($cpuCooler instanceof CpuCooler) {
            $conditions[] = 'maxCpuCoolerHeight >= ' . $cpuCooler->getHeight();
        }

        $mbFormat = $build->getPart('motherboard');
        if ($mbFormat instanceof Mb) {
            switch ($mbFormat->getForm()) {
                case 'Mini-ITX':
                    $format[] = '\'Mini-ITX\'';
                case 'Micro-ATX':
                    $format[] = '\'Micro-ATX\'';
                case 'ATX':
                    $format[] = '\'ATX\'';
                case 'E-ATX':
                    $format[] = '\'E-ATX`\'';
                    break;
            }
            $conditions[] = 'mbFormat IN (' . implode(',', $format) . ')';
        }

        $gpus = $build->getPart('gpus');
        if (count($gpus) > 0) {
            $maxGpuSize = null;
            foreach ($gpus as $object) {
                $value = $object->getLength();
                if ($maxGpuSize === null || $value > $maxGpuSize) {
                    $maxGpuSize = $value;
                }
            }
            $conditions[] = 'maxGpuSize >= ' . $maxGpuSize;
        }


        $psu = $build->getPart('psu');
        if ($psu instanceof Psu) {
            $conditions[] = 'psuFormat = \'' . $psu->getFormat() . '\'';
        }

        return $conditions;
    }
}
