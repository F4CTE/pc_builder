<?php
namespace App;

class CpuCoolerImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        return new CpuCooler(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['Height']),
            explode(', ', $arrayItem['sockets']),
            $arrayItem['mpn'] ?? null,
            $arrayItem['ean'] ?? null,
            $arrayItem['image_url'] ?? null,
            null
        );
    }
}