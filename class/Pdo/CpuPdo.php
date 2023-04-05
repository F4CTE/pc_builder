<?php

namespace App\Cpu;

use App\Build\build;
use App\Mb\Mb;
use App\Parent\PartPdo;
use PDO;

class CpuPdo extends PartPdo
{
    private const TABLE_NAME = 'cpus';
    private const UPDATE_QUERY = 'UPDATE cpus SET name = :name, producer = :producer, baseClock = :baseClock, turboClock = :turboClock, cores = :cores, threads = :threads, socket = :socket, tdp = :tdp, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id';
    private const INSERT_QUERY = 'INSERT INTO cpus (name, producer, baseClock, turboClock, cores, threads, socket, tdp, mpn, ean, imageLink) VALUES (:name, :producer, :baseClock, :turboClock, :cores, :threads, :socket, :tdp, :mpn, :ean, :imageLink)';
    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    public function jsonToObject(array $arrayItem): Cpu
    {
        $cpu = new Cpu(
            $arrayItem['name'],
            $arrayItem['Producer'],
            floatval($arrayItem['basse_clock']),
            floatval($arrayItem['turbo_clock']),
            $arrayItem['cores'],
            $arrayItem['threads'],
            $arrayItem['socket'],
            intval($arrayItem['TDP']),
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['cpu_image_link'] ?? null,
            null,
        );
        return $cpu;
    }

    public function rowToObject(array|bool $row): Cpu|bool
    {
        if (!$row) {
            return $row;
        } else
            return new Cpu(
                $row['name'],
                $row['producer'],
                floatval($row['baseClock']),
                floatval($row['turboClock']),
                intval($row['cores']),
                intval($row['threads']),
                $row['socket'],
                intval($row['tdp']),
                $row['mpn'],
                $row['ean'],
                $row['imageLink'],
                intval($row['id']),
            );
    }

    public function objectToRow($item): array
    {
        return [
            'name' => $item->getName(),
            'producer' => $item->getProducer(),
            'baseClock' => $item->getBaseClock(),
            'turboClock' => $item->getTurboClock(),
            'cores' => $item->getCores(),
            'threads' => $item->getThreads(),
            'socket' => $item->getSocket(),
            'tdp' => $item->getTdp(),
            'mpn' => $item->getMpn(),
            'ean' => $item->getEan(),
            'imageLink' => $item->getImageLink(),
        ];
    }

    protected function getCompatibilityQuery(?Build $build): ?array
    {
        $conditions = [];

        if ($build !== null) {
            $motherboard = $build->getPart('motherboard');
            if ($motherboard instanceof Mb) {
                $conditions[] = 'socket = \'' . $motherboard->getSocket() . '\'';
            }
        }

        return $conditions;
    }
}
