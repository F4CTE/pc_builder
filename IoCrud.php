<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Build\Build;
use App\Build\BuildPdo;
use App\Chassis\Chassis;
use App\Chassis\ChassisPdo;
use App\Cpu\Cpu;
use App\Cpu\CpuPdo;
use App\CpuCooler\CpuCooler;
use App\CpuCooler\CpuCoolerPdo;
use App\Gpu\Gpu;
use App\Gpu\GpuPdo;
use App\Hdd\Hdd;
use App\Hdd\HddPdo;
use App\Mb\Mb;
use App\Mb\MbPdo;
use App\Parent\PdoDb;
use App\Psu\Psu;
use App\Psu\PsuPdo;
use App\Ram\Ram;
use App\Ram\RamPdo;
use App\Ssd\Ssd;
use App\Ssd\SsdPdo;
use App\User\User;
use App\User\UserPdo;


session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['request']) && $_SESSION['isAdmin'] === true) {
    header('Content-type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Origin: *');
    $pdo = getPdo();
    if (isset($_GET['id'])) {
        echo json_encode($pdo->getById($_GET['id']));
    } else {
        echo json_encode($pdo->getAll());
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['isAdmin'] === true) {
    header('Content-type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Origin: *');

    // Read the raw POST data and decode the JSON payload
    $rawData = file_get_contents("php://input");
    $jsonData = json_decode($rawData, true);

    $entity = getEntity($jsonData['entityType'], $jsonData['entity']);
    $response = [];
    if ($jsonData['operationType'] === 'update' || $jsonData['operationType'] === 'create') {
        $result = $entity->save();
        $response['status'] = $result ? 'success' : 'error';
        $response['operation'] = $jsonData['operationType'];
    } elseif ($jsonData['operationType'] === 'delete') {
        $result = $entity->destroy();
        $response['status'] = $result ? 'success' : 'error';
        $response['operation'] = $jsonData['operationType'];
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid operation type.';
    }
    echo json_encode($response);
} else {
    header('location: index.php');
    exit;
}

function getPdo(): PdoDb
{
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
        case 'cpucoolers':
            return new CpuCoolerPdo();
            break;
        case 'gpus':
            return new GpuPdo();
            break;
        case 'hdds':
            return new HddPdo();
            break;
        case 'motherboards':
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

function getEntity($entityType, $row)
{

    $array = is_string($row) ? json_decode($row, true) : $row;
    $array = prepareRowData($array);


    switch ($entityType) {
        case 'builds':
            return (new BuildPdo())->rowToObject($array);
            break;
        case 'chassis':
            return (new ChassisPdo())->rowToObject($array);
            break;
        case 'cpus':
            return (new CpuPdo())->rowToObject($array);
            break;
        case 'cpucoolers':
            return (new CpuCoolerPdo())->rowToObject($array);
            break;
        case 'gpus':
            return (new GpuPdo())->rowToObject($array);
            break;
        case 'hdds':
            return (new HddPdo())->rowToObject($array);
            break;
        case 'motherboards':
            return (new MbPdo())->rowToObject($array);
            break;
        case 'psus':
            return (new PsuPdo())->rowToObject($array);
            break;
        case 'rams':
            return (new RamPdo())->rowToObject($array);
            break;
        case 'ssds':
            return (new SsdPdo())->rowToObject($array);
            break;
        case 'users':
            return (new userPdo())->rowToObject($array);
            break;
        default:
            return null;
    }
}

function prepareRowData($row)
{
    $row = is_string($row) ? json_decode($row, true) : $row;

    foreach ($row as $key => $value) {
        if (is_string($value) && isJson($value)) {
            $row[$key] = json_decode($value, true);
        }
    }

    return $row;
}

function isJson($string)
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}
