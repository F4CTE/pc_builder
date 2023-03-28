<?php

use App\Hdd\HddPdo;

require_once __DIR__ . '/vendor/autoload.php';
session_start();


$hdd = (new HddPdo())->getById(275);
var_dump($hdd); 
