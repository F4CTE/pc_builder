<?php
session_start();

$_SESSION = array();

session_destroy();

require_once __DIR__ . '/public/templates/logout.php';
header("refresh:5; url=index.php");
exit();
?>