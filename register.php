<?php

use App\User\User;
use App\User\UserPdo;

require_once __DIR__ . '/vendor/autoload.php';

session_start();

if (isset($_SESSION['user'])) {
    $_SESSION['error'] = "You are already registered and logged in.";
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ((new UserPdo())->getByUsername(trim($_POST['username'])) || (new UserPdo())->getByEmail(trim($_POST['email']))) {
        $_SESSION['error'] = 'Email or username already in use. would you like to <a href="login.php">login</a> ?';
    }

    $user = (new User(trim($_POST['username']), trim($_POST['email'])))->setPassword($_POST['password']);

    if ($user) {
        $_SESSION['message'] = "Registration successful! You can now log in.";
        header('Location: login.php');
        exit();
    } else {
        $_SESSION['error'] = "Unable to register. Please try again.";
    }
}

require_once __DIR__ . '/public/templates/register.php';
