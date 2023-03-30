<?php

use App\Build\build;
use App\Build\BuildPdo;
use App\Cpu\CpuPdo;

$pageTitle = "Home";
require_once __DIR__ . '/head.php';
?>

<body>
    <?php require_once __DIR__ . '/header.php'; ?>
    <main>
        <?php
        $build = new build();
        $build->setIndividualPart('motherboard', 403);
        $buildPdo = (new CpuPdo())->getCompatibleItems($build);
        var_dump($buildPdo);
        ?>
    </main>
    <?php require_once __DIR__ . '/footer.php'; ?>
</body>