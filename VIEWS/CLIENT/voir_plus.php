<?php 
include_once ('../../config/database.php');
session_start();
include("../../VIEWS/headerr.php"); 

$database = new Database();
$conn = $database->getConnection();

$limit = 6;
$offset = 0;

$sql = "SELECT * FROM produits LIMIT $limit OFFSET $offset";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produits = $stmt->fetchAll();

// هذا الجزء من بعد HTML أو في نفس الملف، ولكن يكون مستقل ويخدم غير مع AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offset'])) {
    $offset = intval($_POST['offset']);
    $limit = 6;

    $sql = "SELECT * FROM produits LIMIT $limit OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produits = $stmt->fetchAll();

    foreach ($produits as $produit) {
        echo '<div class="product-card">';
        echo '<img src="images/' . $produit['image'] . '" alt="' . $produit['nom'] . '">';
        echo '<h3>' . $produit['nom'] . '</h3>';
        echo '<p>' . $produit['prix'] . ' MAD</p>';
        echo '</div>';
    }

    exit; // مهم باش ميكملش الصفحة
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nos Produits</title>
  <link rel="stylesheet" href="style_produits.css">
      <link rel="stylesheet" href="panierr.css">
    <link rel="stylesheet" href="style_loginn.css">
    <script src="script_homee.js" ></script>
     <link rel="stylesheet" href="panierr.css">
</head>
<body>

<h1>Nos Produits</h1>

<!-- الحاوية ديال المنتجات -->
<div id="produits-container">
  <?php foreach ($produits as $produit): ?>
    <div class="product-card">
      <img src="images/<?= $produit['image']; ?>" alt="<?= $produit['nom']; ?>">
      <h3><?= $produit['nom']; ?></h3>
      <p><?= $produit['prix']; ?> MAD</p>
    </div>
  <?php endforeach; ?>
</div>

<!-- الزر ديال voir plus -->
<button id="voir-plus">Voir plus</button>

<script>
let offset = 6;

document.getElementById("voir-plus").addEventListener("click", function() {
  fetch("", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "offset=" + offset
  })
  .then(response => response.text())
  .then(data => {
    if (data.trim() !== "") {
      document.getElementById("produits-container").insertAdjacentHTML("beforeend", data);
      offset += 6;
    } else {
      this.style.display = "none";
    }
  });
});
</script>
</body>
</html>
