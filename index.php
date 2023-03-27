<?php

use App\Hdd\HddPdo;

require_once __DIR__ . '/vendor/autoload.php';
session_start();

var_dump((new HddPdo())->getById(15));