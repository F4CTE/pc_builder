<?php

use App\User\UserPdo;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

(new Dotenv())->loadEnv(__DIR__.'/../../.env');

session_start();

if (isset($_SESSION['user']) or $_SERVER['REQUEST_METHOD'] !== ('POST' or 'GET')) {
    $_SESSION['error'] = "You are already logged in.";
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $_ENV['MAX_LOGIN_ATTEMPTS']) {
    $remainingTime = $_ENV['LOGIN_ATTEMPTS_TIMEOUT'] - (time() - $_SESSION['last_login_attempt']);
    $_SESSION['error'] = "Too many failed login attempts. Please try again in $remainingTime seconds.";
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($username_or_email) || empty($password)) {
        loginAtempsIncrement();
        $_SESSION['error'] = "Please enter your email/username and password.";
        header("Location: login.php");
        exit();
    }

    if (filter_var($_POST, FILTER_VALIDATE_EMAIL)) {
        $user = (new UserPdo())->getByEmail(trim($_POST['username_or_email']));
    } else {
        $user = (new UserPdo())->getByUsername(trim($_POST['username_or_email']));
    }

    if (is_null($user)) {
        loginAtempsIncrement();
        $_SESSION['error'] = "The email/username you entered does not exist.";
        header('Location: login.php');
        exit();
    } else if ($user->isPasswordCorrect($_POST['password'])) {
        unset($_SESSION['login_attempts'], $_SESSION['last_login_attempt']);
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    } else {
        loginAtempsIncrement();
        $_SESSION['error'] = "The password you entered is incorrect.";
        header('Location: login.php');
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/templates/login.php';
    exit();
}

function loginAtempsIncrement()
{
    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
    $_SESSION['last_login_attempt'] = time();
}
