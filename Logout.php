<?php
session_start();

if (!isset($_SESSION['user_id']) && isset($_SESSION['login_attempts'])) {
    header("Location: index.php");
    exit();
}
$_SESSION = array();

session_destroy();
header("refresh:5; url=index.php");
require_once __DIR__ . '/public/templates/logout.php';
exit();
