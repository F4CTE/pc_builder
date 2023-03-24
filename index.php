<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use App\CpuImport;
use App\ChassisImport;
use App\ChassisPdo;
use App\CpuCoolerImport;
use App\GpuImport;
use App\GpuPdo;
use App\HddImport;
use App\HddPdo;
use App\MbImport;
use App\MbPdo;
use App\ObjectToDb;
use App\PsuImport;
use App\PsuPdo;
use App\RamImport;
use App\SsdImport;
use App\SsdPdo;
use App\UserPdo;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');
(new SsdPdo())->import(__DIR__ . '/json/SSDs.json');