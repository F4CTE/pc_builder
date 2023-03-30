<?php

namespace App\Mb;

use App\Parent\DbItem;
use App\Parent\PdoDb;

class MbPdo extends PdoDb
{

    private const TABLE_NAME = 'motherboards';
    private const UPDATE_QUERY = "UPDATE motherboards SET name = :name, producer = :producer, socket = :socket, chipset = :chipset, form = :form, memoryType = :memoryType, ports = :ports, memoryCapacity = :memoryCapacity, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO motherboards (name, producer, socket, chipset, form, memoryType, ports, memoryCapacity, mpn, ean, imageLink) VALUES (:name, :producer, :socket, :chipset, :form, :memoryType, :ports, :memoryCapacity, :mpn, :ean, :imageLink)";


    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    public function jsonToObject(array $arrayItem): Mb
    {
        $mb = new Mb(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['socket'],
            $arrayItem['chipset'],
            $arrayItem['form'],
            $arrayItem['memory_type'],
            array(
                'ram' => intval($arrayItem['ramslots'] ?? 0),
                'sata' => intval($arrayItem['sata'] ?? 0),
                'm2Pcie3' => intval($arrayItem['m2_pcie3'] ?? 0),
                'm2Pcie4' => intval($arrayItem['m2_pcie4'] ?? 0),
                'pcie3X1' => intval($arrayItem['pcie_3_x1'] ?? 0),
                'pcie3X16' => intval($arrayItem['pcie_3_x16'] ?? 0),
                'pcie4X1' => intval($arrayItem['pcie_4_x1'] ?? 0),
                'pcie4X16' => intval($arrayItem['pcie_4_x16'] ?? 0),
            ),
            $arrayItem['memory_capacity'] ?? null,
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['selection2'] ?? null,
            null
        );
        return $mb;
    }

    public function objectToRow($item): array
    {
        return [
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':socket' => $item->getSocket(),
            ':chipset' => $item->getChipset(),
            ':form' => $item->getForm(),
            ':memoryType' => $item->getMemoryType(),
            ':ports' => json_encode($item->getPorts()),
            ':memoryCapacity' => $item->getMemoryCapacity(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

    public function rowToObject(array|bool $row): MB|bool
    {
        if (!$row){
            return $row;
        } else 
        return new Mb(
            $row['name'],
            $row['producer'],
            $row['socket'],
            $row['chipset'],
            $row['form'],
            $row['memoryType'],
            json_decode($row['ports'], true),
            $row['memoryCapacity'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
        
    }

}
