<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/assets/style/style.css">
    <link rel="icon" href="public/assets/burger.png" type="image/x-icon">
    <title>Food Mania</title>
</head>
<body>
    <h1>Hello you</h1>

    <?php if (isset($_SESSION['user'])) {

            $user = $_SESSION['user'];
            if ($user->getState() == 0 || $user->getState() == '') { ?>
                <button class="home-button">
                    <a href="/food-mania/login">Login</a>
                </button>
                <button class="home-button">
                    <a href="/food-mania/register">Register</a>
                </button>
            <?php }
        } ?>
        <?php if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getState() == 1) { ?>
            <button class="home-button">
                    <a href="/food-mania/search-product">Search products</a>
                </button>
                <button class="home-button">
                    <a href="/food-mania/logout">Logout</a>
                </button>
            <?php }
        } ?>


</body>
</html>