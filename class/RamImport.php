<?php 
namespace App;
class RamImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        return new Ram(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['RAM_TYPE'],
            intval($arrayItem['size']),
            $arrayItem['clock'],
            $arrayItem['sticks'],
            $arrayItem['MPN'],
            $arrayItem['EAN'],
            $arrayItem['image_url'] ?? Part::defaultImage,
            null
        );
    }
}