<?php 
session_start();
include("../../VIEWS/headerr.php"); 
include_once ('../../config/database.php');


// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "electro_ecommerce");

// جلب الصورة
$sql = "SELECT * FROM image_home LIMIT 1";
$result = $conn->query($sql);

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$cartCount = count($_SESSION['panier']); // باش تبين فـ header

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ElectroShop</title>
    <link rel="stylesheet" href="style_homee.css">
    <link rel="stylesheet" href="panierr.css">
    <link rel="stylesheet" href="style_loginn.css">
    <script src="script_homee.js" ></script>
    <link rel="stylesheet" href="header.css">

</head>
<body style="background: linear-gradient(135deg, black, rgba(59, 57, 57, 1), black);">

<main>
    <div>
        <div class="text">
            <h1>Bienvenue chez ElectroShop</h1>
            <strong>
                <p style="color:white;">
                    Découvrez une sélection exclusive de produits électroniques à la pointe de la technologie.
                </p>
                <p style="color:white;">
                    Performances, fiabilité et petits prix sont au cœur de notre engagement pour vous satisfaire.
                </p>
            </strong>
        </div>
        <div class="buttons">
            <a style="color:white" href="produits.php" class="btn">Voir les produits</a>
            <a style="color:white" href="contact.php" class="btn">Nous contacter</a>
        </div>
    </div>
    <div>
        <?php if ($result->num_rows > 0): ?>
        <?php $row = $result->fetch_assoc(); ?>
        <img src="/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['titre']); ?>">
        <?php endif; ?> 
    </div>
</main>

</body>
</html>