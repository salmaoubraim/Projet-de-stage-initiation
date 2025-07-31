<?php
session_start();
require_once '../../CONFIG/Database.php';
include("../../VIEWS/headerr.php");

// ربط قاعدة البيانات
$database = new Database();
$db = $database->getConnection();

// جلب بيانات المنتجات حسب IDs لي كاينين فـ السلة
function getProduitsPanier($db, $panier) {
    if (empty($panier)) return [];

    $ids = implode(',', array_map('intval', array_keys($panier)));
    $stmt = $db->prepare("SELECT * FROM produits WHERE id IN ($ids)");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// vider panier
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['vider']) && $_GET['vider'] === 'true') {
    $_SESSION['panier'] = [];
    echo json_encode(['status' => 'success']);
    exit;
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
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
            margin-top: 30px;
            margin-left: 14%;
        }
        th, td {
            border: 2px solid black;
            padding: 12px;
            text-align: center;
        }
        img {
            width: 100px;
        }
        #voir-plus:hover {
            background-color: #88908b;
        }
        #voir-plus {
            margin-left: 43%;
            margin-top: 40px;
            text-decoration: none;
            padding: 10px 30px;
            background-color: black;
            border-radius: 10px;
            color: white;
            font-size: large;
            cursor: pointer;
            border: none;
        }
        h2 {
            text-align: center;
        }
        h3 {
            text-align: center;
        }
    </style>
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
                    <td><img src="images/<?php echo htmlspecialchars($produit['image']); ?>?t=<?php echo time(); ?>" alt="image" /></td>
                    <td><?php echo htmlspecialchars($produit['nom']); ?></td>
                    <td><?php echo htmlspecialchars($produit['description']); ?></td>
                    <td><?php echo number_format($produit['prix'], 2); ?> DH</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button id="voir-plus">Vider le panier</button>

<?php endif; ?>

<script>
document.getElementById('voir-plus').addEventListener('click', function () {
    fetch('panier.php?vider=true')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();  // هنا كاين التحديث
            }
        })
        .catch(error => console.error('Erreur:', error));
});


</script>

</body>
</html>
