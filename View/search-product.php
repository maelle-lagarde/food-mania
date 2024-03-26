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
        <h1>Products</h1>

        <div class="header">
            <a class="header-icon" href="/food-mania/">
                <img src="public/assets/home.svg" alt="home icon" id="home-icon">
            </a>

            <a class="header-icon" href="/food-mania/my-products">
                <img src="public/assets/basket.svg" alt="basket icon" id="basket-icon"> 
            </a>
        </div>      
        
        <div class="search-form">
            <input class="search-product-input" type="text" name="search-product-input" id="search-product-input" placeholder="patate douce ?" required>
            <button type="submit" class="submit">search</button>
        </div>
        
        <div id="container-product"></div>

    </div>

    <script src="src/apiexterne/search-product.js" defer></script>
    
</body>
</html>