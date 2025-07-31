<?php
include_once('../../config/database.php');
session_start();

$database = new Database();
$conn = $database->getConnection();

// التحقق من ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Produit non spécifié ou invalide.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    echo "Produit non trouvé.";
    exit;
}

// تهيئة السلة
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// الرسالة
$message = "";

// التعامل مع POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commander'])) {
    $prodId = intval($_POST['commander']);
    if (!in_array($prodId, $_SESSION['panier'])) {
        $_SESSION['panier'][] = $prodId;
        $message = "Produit ajouté au panier avec succès !";
    } else {
        $message = "Produit déjà dans le panier.";
    }
}

// واش راه المنتج فالسلة؟
$estDansPanier = in_array($produit['id'], $_SESSION['panier']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Détail produit - <?= htmlspecialchars($produit['nom']) ?></title>
<link rel="stylesheet" href="style_detail_produits.css">
</head>
<body>
<div id="popup-success" style=" margin-top: 50px; display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%); background-color: white; padding:20px; border:1px solid #0a0; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.2); z-index:999;">
  <p style="color: black; font-weight:bold;">Commande effectuée avec succès !</p>
  <button onclick="document.getElementById('popup-success').style.display='none'">Fermer</button>
</div>

<h1><?= htmlspecialchars($produit['nom']) ?></h1>
<p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
<p><strong>Prix:</strong> <?= number_format($produit['prix'], 2) ?> MAD</p>
<p><strong>N.B: Livraison est gratuite ;</strong><br><br>

<?php if ($message): ?>
  <div class="message"><?= $message ?></div>
<?php endif; ?>



<?php if ($estDansPanier): ?>
  <!-- المنتج موجود فالسلة -->
<button class="btn btn-commander" onclick="showSuccessPopup()">Commander</button>

<?php else: ?>
  <!-- المنتج مازال ما تزادش -->
  <form method="post">
    <input type="hidden" name="commander" value="<?= $produit['id'] ?>" />
    <button type="submit" class="btn">Ajouter au panier</button>
  </form>
<?php endif; ?>

<script>
  function showSuccessPopup() {
    const popup = document.createElement("div");
    popup.innerHTML = `
      <div style=" margin-left: 44%;
       padding:20px; border:2px solid #88908b; border-radius:10px; width:300px; text-align:center; box-shadow:0 0 10px rgba(0,0,0,0.3);">
        <strong>Commande effectuée avec succès !</strong><br><br>
        <button onclick="this.parentElement.parentElement.remove()" style="margin-top:10px; background-color: #88908b; color:white; border:none; padding:8px 12px; border-radius:5px; cursor:pointer;">
          Fermer
        </button>
      </div>
    `;
    popup.style.position = "fixed";
    popup.style.top = "30%";
    popup.style.left = "50%";
    popup.style.transform = "translate(-50%, -50%)";
    popup.style.zIndex = "9999";

    document.body.appendChild(popup);
  }


</script>

</body>
</html>
