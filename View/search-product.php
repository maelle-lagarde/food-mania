<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/assets/burger.png" type="image/x-icon">
    <title>Food Mania</title>
</head>
<body>
    <h1>Display Product</h1>

        <?php
            // Effectue une requête HTTP GET à l'URL fournie
            $response = file_get_contents('https://world.openfoodfacts.org/api/v2/product/3017624010701?fields=product_name,nutriscore_data');

            // Convertit la réponse JSON en tableau associatif
            $data = json_decode($response, true);

            // Récupère les données pertinentes
            $product_name = $data['product']['product_name'];
            $nutriscore_data = json_encode($data['product']['nutriscore_data']);

            // Affiche les données dans le tableau
            echo "<h2>$product_name</h2>";
            echo "<p>$nutriscore_data</p>";
            ?>

    <script src="src/apiexterne/searchProduct.js"></script>
</body>
</html>
