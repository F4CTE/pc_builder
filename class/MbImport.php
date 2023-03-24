<?php
namespace App;

class MbImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        return new Mb(
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
            $arrayItem['memory_capacity'] = null,
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['selection2'],
            null
        );
    }
}