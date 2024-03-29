<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

use App\Model\Product;

$productInstance = new Product();
$products = $productInstance->findAll();

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
        <h1>My products</h1>

        <div class="header">
            <a class="header-icon" href="/food-mania/">
                <img src="public/assets/home.svg" alt="home icon" id="home-icon">
            </a>

            <a class="header-icon" href="/food-mania/search-product">
                <img src="public/assets/search.svg" alt="search icon" id="search-icon"> 
            </a>
        </div>  

        <div id="container-product">
                <?php foreach ($products as $product) : ?>
                    <div class="div-product">
                        <h2><?= $product->getName() ?></h2>
                        <p><?= $product->getDescription() ?></p>
                        <?php 
                        $productUrl = $product->getImage();
                        $productImage = base64_encode($productUrl);
                        ?>
                        <img src="data:image/jpeg;base64,<?= $productImage ?>" alt="Image">
                    </div>
                <?php endforeach; ?>

        </div>

    </div>
    
</body>
</html>
