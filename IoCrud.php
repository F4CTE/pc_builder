<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Build\BuildPdo;
use App\Chassis\ChassisPdo;
use App\Cpu\CpuPdo;
use App\CpuCooler\CpuCoolerPdo;
use App\Gpu\GpuPdo;
use App\Hdd\HddPdo;
use App\Mb\MbPdo;
use App\Parent\PdoDb;
use App\Psu\PsuPdo;
use App\Ram\RamPdo;
use App\Ssd\SsdPdo;
use App\User\UserPdo;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['request'])) {
    header('Content-type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Origin: *');
    $pdo = getPdo();
    if(isset($_GET['id'])) {
        echo json_encode($pdo->getById($_GET['id']));
    } else {
        echo json_encode($pdo->getAll());
    }
}else {
    header('location: index.php');
    exit;
}

function getPdo(): PdoDb {
    switch ($_GET['request']) {
        case 'builds':
            return new BuildPdo();
            break;
        case 'chassis':
            return new ChassisPdo();
            break;
        case 'cpus':
            return new CpuPdo();
            break;
        case 'cpuCoolers':
            return new CpuCoolerPdo();
            break;
        case 'gpus':
            return new GpuPdo();
            break;
        case 'hdds':
            return new HddPdo();
            break;
        case 'mbs':
            return new MbPdo();
            break;
        case 'psus':
            return new PsuPdo();
            break;
        case 'rams':
            return new RamPdo();
            break;
        case 'ssds':
            return new SsdPdo();
            break;
        case 'users':
            return new UserPdo();
            break;
        default:
            return null;
    }
}