<?php

namespace App;

class PsuImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        return new Psu(
            $arrayItem['name'],
            $arrayItem['producer'],
            $arrayItem['watt'],
            array("pin_8" => $arrayItem['pin_8'], "pin_6" => $arrayItem['pin_6']),
            $arrayItem['size'],
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'],
            null
        );
    }
}