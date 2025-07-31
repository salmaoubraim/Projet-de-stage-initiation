<?php 
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$cartCount = count($_SESSION['panier']); // هادي باش تبين فـ header

include("../../VIEWS/headerr.php"); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ElectroShop</title>
    <link rel="stylesheet" href="style_homee.css">
    <link rel="stylesheet" href="style_loginn.css">
    <link rel="stylesheet" href="panierr.css">
    <script src="script_homee.js"></script>
</head>
<body>

<main>
    <div>
        <div class="text">
            <h1 >Bienvenue chez ElectroShop</h1>
          <strong>  <p style="color:white; ">
                Découvrez une sélection exclusive de produits électroniques à la pointe de la technologie.
            </p>
            <p style="color:white; ">
                Performances, fiabilité et petits prix sont au cœur de notre engagement pour vous satisfaire.
            </p></strong>
        </div>

        <div class="buttons">
            <a style="color:white" href="produits.php" class="btn">Voir les produits</a>
            <a style="color:white" href="contact.php" class="btn">Nous contacter</a>
        </div>
    </div>

    <div>
        <img class="image" src="/electro_ecommerce/public/images/image1 (2).png" alt="image produit">
    </div>
</main>

</body>
</html>
