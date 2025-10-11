<?php 
session_start();
include_once ('../../config/database.php');
$database = new Database();
$conn = $database->getConnection();

// 1. جزء تحميل المنتجات بالـ AJAX (POST مع 'offset')
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offset'])) {
    $offset = intval($_POST['offset']);
    $limit = 6;

    $sql = "SELECT * FROM produit LIMIT $limit OFFSET $offset";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produits = $stmt->fetchAll();

    foreach ($produits as $produit): ?>
        <div class="product-card">
          <img class="images" src="../../images/<?= htmlspecialchars($produit['image']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>">
          <h3><?= htmlspecialchars($produit['nom']) ?></h3>
          <p><?= htmlspecialchars($produit['prix']) ?> MAD</p>
         <a class="voir_detail" href="detail_produit.php?id=<?= $produit['id']; ?>">Voir détails</a><br>
         <span class="panier-icon" onclick="ajouterAuPanier(<?= $produit['id']; ?>)">🛒</span>

        </div>
    <?php
    endforeach;
    exit; // مهم لمنع طباعة بقية الصفحة عند طلب AJAX
}

// 2. الصفحة الرئيسية مع تحميل أول 6 منتجات


$limit = 6;
$offset = 0;

$sql = "SELECT * FROM produit LIMIT $limit OFFSET $offset";
$stmt = $conn->prepare($sql);
$stmt->execute();
$produits = $stmt->fetchAll();

$totalQuery = "SELECT COUNT(*) as total FROM produit";
$totalResult = $conn->query($totalQuery);
$row = $totalResult->fetch(PDO::FETCH_ASSOC);
$totalProduits = $row['total'];

?>
<?php include("../../VIEWS/headerr.php"); ?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Nos Produits</title>
  <link rel="stylesheet" href="style_produits.css">
  <link rel="stylesheet" href="panierr.css">
  <link rel="stylesheet" href="style_loginn.css">
  <script src="script_homee.js" ></script>

  
</head>
<body style="background: linear-gradient(135deg, black, rgba(59, 57, 57, 1), black);">

<h1>Nos Produits</h1>

<!-- حاوية المنتجات -->
<div id="produits-container">
  <?php foreach ($produits as $produit): ?>
    <div class="product-card">
      <img src="../../images/<?= htmlspecialchars($produit['image']); ?>" alt="<?= htmlspecialchars($produit['nom']); ?>">
      <h3><?= htmlspecialchars($produit['nom']); ?></h3>
      <p style="color: #e8edebff"><?= htmlspecialchars($produit['prix']); ?> MAD</p>
      <a class="voir_detail" href="detail_produit.php?id=<?= $produit['id']; ?>">Voir détails</a><br>
      <span class="panier-icon" onclick="ajouterAuPanier(<?= $produit['id']; ?>)">🛒</span>
    </div>
  <?php endforeach; ?>
</div>

<?php if ($totalProduits > $limit): ?>
  <button id="btn-retour" style="display:none;">Retour</button>
  <button id="voir-plus">Voir plus</button>
<?php endif; ?>

<script>
// المتغيرات الأساسية
const offsetInit = <?= $limit ?>;
let offset = offsetInit;
const total = <?= $totalProduits ?>;

const btnVoirPlus = document.getElementById('voir-plus');
const btnRetour = document.getElementById('btn-retour');
const container = document.getElementById('produits-container');
const initialHTML = container.innerHTML;

// تحميل المزيد من المنتجات عبر AJAX
btnVoirPlus.addEventListener('click', () => {
  fetch("produits.php", {
    method: "POST",
    headers: {"Content-Type": "application/x-www-form-urlencoded"},
    body: "offset=" + offset
  })
  .then(res => res.text())
  .then(data => {
if (data.trim() !== "") {
  container.insertAdjacentHTML("beforeend", data);
  offset += offsetInit;

  // ✅ هنا: نخفي "Voir plus" ونظهر "Retour"
  btnVoirPlus.style.display = "none";
  btnRetour.style.display = "inline-block";
}

  });
});

// زر العودة للحالة الأصلية
btnRetour.addEventListener('click', () => {
  container.innerHTML = initialHTML;
  offset = offsetInit;
  btnVoirPlus.style.display = 'inline-block';
  btnRetour.style.display = 'none';
});

// دالة لإضافة منتج للسلة بدون إعادة تحميل
function ajouterAuPanier(idProduit) {
  fetch('ajouter_panier.php?id=' + idProduit)
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      document.getElementById("cart-count").innerText = data.count;
    } else {
      alert("Erreur lors de l'ajout au panier.");
    }
  })
  .catch(e => console.error("Erreur AJAX:", e));
}
</script>

</body>
</html>