<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$file = file_get_contents(__DIR__.'/jsonDb/CPU_COOLERs.json');
$file = json_decode($file,true);
foreach($file as $element) {
    $sockets = $element['sockets'];
    $sockets = explode(', ', $sockets);
    var_dump($sockets);
    
}
