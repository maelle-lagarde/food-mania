<?php
require_once '../vendor/autoload.php';

use App\Model\User;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    if ($user->getState() == 1) {
        $user->disconnect();
        header('Location: home.php');
        exit();
    }
}