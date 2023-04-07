<?php

use App\User\UserPdo;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

(new Dotenv())->loadEnv(__DIR__.'/.env');

session_start();

if (isset($_SESSION['user']) ) {
    $_SESSION['error'] = "You are already logged in.";
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['username_or_email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Please enter your email/username and password.";
    }

    if (filter_var($_POST['username_or_email'], FILTER_VALIDATE_EMAIL)) {
        $user = (new UserPdo())->getByEmail(trim($_POST['username_or_email']));
    } else {
        $user = (new UserPdo())->getByUsername(trim($_POST['username_or_email']));
    }

    if (!$user) {
        $_SESSION['error'] = "The email/username you entered does not exist.";
        loginAtempsIncrement();
    } else if($user->isBanned()){
        $_SESSION['error'] = "You have been banned";
    }else if ($user->isPasswordCorrect($_POST['password'])) {
        unset($_SESSION['login_attempts'], $_SESSION['last_login_attempt']);
        $_SESSION['user'] = $user->getId();
        $_SESSION['isAdmin'] = $user->isAdmin();
        header('Location: index.php');
        exit();
    } else {
        loginAtempsIncrement();
        $_SESSION['error'] = "The password you entered is incorrect.";
    }
} 

    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $_ENV['MAX_LOGIN_ATTEMPTS']) {
        $remainingTime = $_ENV['LOGIN_ATTEMPTS_TIMEOUT'] - (time() - $_SESSION['last_login_attempt']);
        $_SESSION['error'] = "Too many failed login attempts. Please try again in $remainingTime seconds.";
    }

require_once __DIR__ . '/public/templates/login.php';

function loginAtempsIncrement()
{
    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
    $_SESSION['last_login_attempt'] = time();
}