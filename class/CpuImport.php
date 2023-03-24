<?php
namespace App;
class CpuImport extends DataImport
{


    public function createDbItem(array $arrayItem): DbItem
    {
        return new Cpu(
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
    }
}
