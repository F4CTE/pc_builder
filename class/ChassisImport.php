<?php
namespace App;

class ChassisImport extends DataImport
{

    public function createDbItem(array $arrayItem): DbItem
    {
        return new Chassis(
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
    }
}