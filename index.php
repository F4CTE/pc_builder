<?php

require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

require_once __DIR__ . '/class/Cpu.php';
$file = file_get_contents(__DIR__.'/json/CPUs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $cpu = new Cpu(
        $element['name'],
        $element['Producer'],
        floatval($element['basse_clock']),
        floatval($element['turbo_clock']),
        $element['cores'],
        $element['threads'],
        $element['socket'],
        intval($element['TDP']),
        $element['MPN'] ?? null,
        $element['EAN'] ?? null,
        $element['cpu_image_link'] ?? Part::defaultImage,
        null,
    );
    var_dump($cpu);
}

require_once __DIR__ . '/class/Chassis.php';
$file = file_get_contents(__DIR__.'/json/Cases.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $case = new Chassis(
        $element['name'],
        $element['producer'],
        $element['Motherboard'],
        $element['Psu'] ?? $element['Motherboard'],
        intval($element['gpu_size']),
        intval($element['cpu_cooler_height']),
        $element['mpn'] ?? null,
        $element['ean'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/CpuCooler.php';
$file = file_get_contents(__DIR__.'/json/CPU_COOLERs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $cpuCooler = new CpuCooler(
        $element['name'],
        $element['producer'],
        intval($element['Height']),
        explode(', ',$element['sockets']),
        $element['mpn'] ?? null,
        $element['ean'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/Gpu.php';
$file = file_get_contents(__DIR__.'/json/GPUs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $gpu = new Gpu(
        $element['name'],
        $element['producer'],
        intval($element['boost_clock']),
        intval($element['vram']),
        intval($element['memory_clock']),
        intval($element['length']),
        array("pin_8" => intval($element['pin_8']), "pin_6" => intval($element['pin_6'])),
        intval($element['TDP']),
        $element['MPN'] ?? null,
        $element['EAN'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/Hdd.php';
$file = file_get_contents(__DIR__.'/json/HDDs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    if($element['producer'] == '3.5"' || $element['producer'] == '2.5"' || $element['producer'] == 'Link' ) {

        if(explode(' ',$element['name'])[0] == 'Western' || explode(' ',$element['name'])[0] == 'WD'){
            $element['producer'] = 'Western Digital';
        } else $element['producer'] = explode(' ',$element['name'])[0];
    }
    $hdd = new Hdd(
        $element['name'],
        $element['producer'],
        intval($element['size']) * 1000,
        intval($element['rpm']),
        $element['mpn'] ?? null,
        $element['ean'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/Mb.php';
$file = file_get_contents(__DIR__.'/json/MOTHERBOARDs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $motherboard = new Mb(
        $element['name'],
        $element['producer'],
        $element['socket'],
        $element['chipset'],
        $element['form'],
        $element['memory_type'],
        array(
            'ram'=>intval($element['ramslots'] ?? 0),
            'sata'=>intval($element['sata'] ?? 0), 
            'm2Pcie3'=>intval($element['m2_pcie3'] ?? 0), 
            'm2Pcie4'=>intval($element['m2_pcie4'] ?? 0),
            'pcie3X1'=>intval($element['pcie_3_x1'] ?? 0), 
            'pcie3X16'=>intval($element['pcie_3_x16'] ?? 0), 
            'pcie4X1'=>intval($element['pcie_4_x1'] ?? 0), 
            'pcie4X16'=>intval($element['pcie_4_x16'] ?? 0),
        ),
        $element['memory_capacity'] = null,
        $element['MPN'] ?? null,
        $element['EAN'] ?? null,
        $element['selection2'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/Psu.php';
$file = file_get_contents(__DIR__.'/json/PSUs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $psu = new Psu(
        $element['name'],
        $element['producer'],
        $element['watt'],
        array("pin_8" => $element['pin_8'] ?? null, "pin_6" => $element['pin_6'] ?? null ),
        $element['size'] ?? null,
        $element['mpn'] ?? null,
        $element['ean'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/Ram.php';
$file = file_get_contents(__DIR__.'/json/RAMs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $ram = new Ram(
        $element['name'],
        $element['producer'],
        $element['RAM_TYPE'],
        intval($element['size']),
        $element['clock'],
        $element['sticks'],
        $element['MPN'] ?? null,
        $element['EAN'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}

require_once __DIR__ . '/class/Ssd.php';
$file = file_get_contents(__DIR__.'/json/SSDs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $ssd = new Ssd(
        $element['name'],
        $element['producer'],
        $element['form'],
        $element['protocol'],
        intval($element['size']),
        $element['controller'] ?? null,
        $element['nand'] ?? null,
        $element['mpn'] ?? null,
        $element['ean'] ?? null,
        $element['image_url'] ?? Part::defaultImage,
        null
    );
}
