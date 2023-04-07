<?php
$pageTitle = 'My Builds';
require_once __DIR__ . '/vendor/autoload.php';
session_start();

if(!isset($_SESSION['id'])){
    header('location : register.php');
    exit;
}
require_once __DIR__ . '/public/templates/head.php';
?>

<body>
    <?php require_once __DIR__ . '/public/templates/header.php'; ?>
    <main>
        <?php

        ?>
    </main>
    <?php require_once __DIR__ . '/public/templates/footer.php'; ?>
</body>