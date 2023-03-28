<?php

namespace App\Ssd;

use App\Parent\DbItem;
use App\Parent\PdoDb;

class SsdPdo extends PdoDb
{  
    private const TABLE_NAME = 'ssds';
    private const UPDATE_QUERY = "UPDATE ssds SET name = :name, producer = :producer, form = :form, protocol = :protocol, storage = :storage, controller = :controller, nand = :nand, mpn = :mpn, ean = :ean, imageLink = :imageLink WHERE id = :id";
    private const INSERT_QUERY = "INSERT INTO ssds (name, producer, form, protocol, capacity, controller, nand, mpn, ean, imageLink) VALUES (:name, :producer, :form, :protocol, :capacity, :controller, :nand, :mpn, :ean, :imageLink)";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME, self::UPDATE_QUERY, self::INSERT_QUERY);
    }

    public function jsonToObject(array $arrayItem): Ssd
    {
        $ssd = new Ssd(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['form'],
            $arrayItem['protocol'],
            intval($arrayItem['size']),
            $arrayItem['controller'] ?? null,
            $arrayItem['nand'] ?? null,
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? null,
            null
        );
        $ssd->save();
        return $ssd;
    }

    public function rowToObject(array $row): DbItem
    {
        return new Ssd(
            $row['name'],
            $row['producer'],
            $row['form'],
            $row['protocol'],
            $row['storage'],
            $row['controller'],
            $row['nand'],
            $row['mpn'],
            $row['ean'],
            $row['imageLink'],
            $row['id']
        );
    }

    public function objectToRow( $item): array
    {
        return [
            ':name' => $item->getName(),
            ':producer' => $item->getProducer(),
            ':form' => $item->getForm(),
            ':protocol' => $item->getProtocol(),
            ':capacity' => $item->getSize(),
            ':controller' => $item->getController(),
            ':nand' => $item->getNand(),
            ':mpn' => $item->getMpn(),
            ':ean' => $item->getEan(),
            ':imageLink' => $item->getImageLink()
        ];
    }

}
