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
    <h1>Display Product</h1>

        <?php
            $response = file_get_contents('https://world.openfoodfacts.org/api/v2/product/3017624010701?fields=product_name,nutriscore_data');

            $data = json_decode($response, true);

            $product_name = $data['product']['product_name'];
            $nutriscore_data = json_encode($data['product']['nutriscore_data']);

            echo "<h2>$product_name</h2>";
            echo "<p>$nutriscore_data</p>";
            ?>

    <script src="src/apiexterne/searchProduct.js"></script>

    <a href="/food-mania/" class="home-button">Home</a>

</body>
</html>
