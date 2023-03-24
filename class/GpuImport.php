<?php
namespace App;

class GpuImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        return new Gpu(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['boost_clock']),
            intval($arrayItem['vram']),
            intval($arrayItem['memory_clock']),
            intval($arrayItem['length']),
            array("pin_8" => intval($arrayItem['pin_8']), "pin_6" => intval($arrayItem['pin_6'])),
            intval($arrayItem['TDP']),
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['image_url'],
            null
        );
    }
}