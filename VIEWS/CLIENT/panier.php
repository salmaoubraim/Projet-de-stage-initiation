<?php
session_start();
include("../../VIEWS/headerr.php"); 
require_once '../../CONFIG/database.php';

// ربط قاعدة البيانات
$database = new Database();
$db = $database->getConnection();

// جلب بيانات المنتجات حسب IDs لي كاينين فـ السلة
function getProduitsPanier($db, $panier) {
    if (empty($panier)) return [];

    $ids = implode(',', array_map('intval', array_keys($panier)));
    $stmt = $db->prepare("SELECT * FROM produit WHERE id IN ($ids)");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



$panier = $_SESSION['panier'] ?? [];
$produits = getProduitsPanier($db, $panier);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panier</title>
    <script src="script_homee.js"></script>
    <link rel="stylesheet" href="panierr.css">
    <link rel="stylesheet" href="style_loginn.css">
</head>
<body style="background-color: white; color: black;">

<h2>Mon panier</h2>

<?php if (empty($produits)): ?>
    <h3>Votre panier est vide.</h3>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><img class="petite_image" src="../../images/<?php echo htmlspecialchars($produit['image']); ?>?t=<?php echo time(); ?>" alt="image" /></td>
                    <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                    <td><?php echo htmlspecialchars($produit['description']); ?></td>
                    <td><?php echo number_format($produit['prix'], 2); ?> DH</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button style="margin-buttom: 50px;" id="voir-pluss">Vider le panier</button>

<?php endif; ?>
<script>
document.getElementById('voir-pluss').addEventListener('click', function () {
    fetch('vider_panier.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            }
        })
        .catch(error => console.error('Erreur:', error));
});
</script>
</body>
</html>
