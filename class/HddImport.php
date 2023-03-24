<?php
namespace App;

class HddImport extends DataImport {
    public function createDbItem(array $arrayItem): DbItem
    {
        if ($arrayItem['producer'] == '3.5"' || $arrayItem['producer'] == '2.5"' || $arrayItem['producer'] == 'Link') {

            if (explode(' ', $arrayItem['name'])[0] == 'Western' || explode(' ', $arrayItem['name'])[0] == 'WD') {
                $arrayItem['producer'] = 'Western Digital';
            } else $arrayItem['producer'] = explode(' ', $arrayItem['name'])[0];
        }
        return new Hdd(
            $arrayItem['name'],
            $arrayItem['producer'],
            intval($arrayItem['size']) * 1000,
            intval($arrayItem['rpm']),
            $arrayItem['mpn'],
            $arrayItem['ean'],
            $arrayItem['image_url'],
            null
        );
    }
}