<?php



require_once __DIR__ . '/vendor/autoload.php';
session_start();

use App\Hdd\HddPdo;

var_dump((new HddPdo())->getById(12));