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
    
    <div class="wrapper">
        <h1>Hello you</h1>

        <?php if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            if ($user->getState() == 0 || $user->getState() == '') { ?>
                <div class="log-button">
                    <a href="/food-mania/login" class="home-button">Login</a>
                    <a href="/food-mania/register" class="home-button">Register</a> 
                </div>
                
            <?php } else if ($user->getState() == 1) { ?>
                <div class="back-button">
                    <a href="/food-mania/search-product" class="header-icon"><img src="public/assets/search.svg" alt="search icon" id="search-icon"></a>
                    <a href="/food-mania/my-products" class="header-icon"><img src="public/assets/basket.svg" alt="basket icon" id="basket-icon"></a>
                    <a href="/food-mania/logout" class="header-icon"><img src="public/assets/logout.svg" alt="logout icon" id="logout-icon"></a>
                </div>
            <?php }
        } else { ?>
            <div class="log-button">
                <a href="/food-mania/login" class="home-button">Login</a>
                <a href="/food-mania/register" class="home-button">Register</a> 
            </div>
            
        <?php } ?>
    </div>

</body>
</html>