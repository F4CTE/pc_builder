<?php

use App\Hdd\HddPdo;
use App\Mb\MbPdo;
use App\Psu\PsuPdo;
use App\Ram\RamPdo;
use App\Ssd\SsdPdo;

require_once __DIR__ . '/../../vendor/autoload.php';



$pageTitle = "Home";
require_once __DIR__ . '/head.php';
?>

<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <main>
        <?php
        var_dump(json_encode((new SsdPdo())->getAll()));
        ?>
    </main>
    <?php require_once __DIR__ . '/footer.php'; ?>
</body>