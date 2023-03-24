<?php
namespace App;
class SsdImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        return new Ssd(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['form'],
            $arrayItem['protocol'],
            intval($arrayItem['size']),
            $arrayItem['controller'],
            $arrayItem['nand'],
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'] ?? Part::defaultImage,
            null
        );
    }
}