<?php
require_once __DIR__ . '/class/Cpu.php';
require_once __DIR__ . '/class/Chassis.php';
require_once __DIR__ . '/class/CpuCooler.php';
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$file = file_get_contents(__DIR__.'/json/CPUs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $cpu = new Cpu(
        $element['name'],
        $element['Producer'],
        floatval($element['basse_clock']) * 1000,
        floatval($element['turbo_clock']) * 1000,
        $element['cores'],
        $element['threads'],
        $element['socket'],
        intval($element['TDP']),
        $element['MPN'] ?? null,
        $element['EAN'] ?? null,
        $element['cpu_image_link'] ?? Part::defaultImage,
        null,
    );
}

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