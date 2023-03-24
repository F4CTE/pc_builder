<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use App\CpuImport;
use App\ChassisImport;
use App\CpuCoolerImport;
use App\GpuImport;
use App\HddImport;
use App\MbImport;
use App\ObjectToDb;
use App\PsuImport;
use App\RamImport;
use App\SsdImport;
use App\UserPdo;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/.env');

$cpuimport = new CpuImport(__DIR__ . '/json/CPUs.json');
$cpuimport->import();

$chassisImport = new ChassisImport(__DIR__ . '/json/Cases.json');
$chassisImport->import();

$CpuCoolerImport = new CpuCoolerImport(__DIR__ . '/json/CPU_COOLERs.json');
$CpuCoolerImport->import();

$gpuImport = new GpuImport(__DIR__ . '/json/GPUs.json');

$hddImport = new HddImport(__DIR__ . '/json/HDDs.json');

$MbImport = new MbImport(__DIR__ . '/json/MOTHERBOARDs.json');

$PsuImport = new PsuImport(__DIR__ . '/json/PSUs.json');

$ramImport = new RamImport(__DIR__ . '/json/RAMs.json');

$ssdimport = new SsdImport(__DIR__ . '/json/SSDs.json');


$pdoDb = new UserPdo();