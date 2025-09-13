<?php
session_start();
require_once '../../CONFIG/database.php';
$database = new Database();
$conn = $database->getConnection();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { exit("Produit non spécifié ou invalide."); }

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM produit WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$produit) exit("Produit non trouvé.");

// Initialiser le panier
if (!isset($_SESSION['panier'])) { $_SESSION['panier'] = []; }

$message = "";

// Ajouter au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $prodId = intval($_POST['ajouter']);
    if (!isset($_SESSION['panier'][$prodId])) {
        $_SESSION['panier'][$prodId] = 1;
        $message = "Produit ajouté au panier avec succès !";
    } else {
        $message = "Produit déjà dans le panier !";
    }
}

// Vérifier si le produit est déjà dans le panier
$estDansPanier = isset($_SESSION['panier'][$produit['id']]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Détail produit - <?= htmlspecialchars($produit['nom']) ?></title>
<link rel="stylesheet" href="style_detail_produits.css">

</head>
<body>

<!-- Container image + nom -->
<div class="produit-container">
    <img class="img-produit" src="../../images/<?= htmlspecialchars($produit['image']); ?>?t=<?= time(); ?>" alt="<?= htmlspecialchars($produit['nom']); ?>">
    <div class="nom-produit"><?= htmlspecialchars($produit['nom']); ?></div>
</div>

<!-- Popup Success -->
<div id="popup-success">
  <p>Votre commande a été effectuée avec succès !</p>
  <p>Livraison prévue dans 2 jours.</p>
  <button onclick="this.parentElement.style.display='none'">Fermer</button>
</div>

<p><strong>Description:</strong><br><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
<p><strong>Prix:</strong> <?= number_format($produit['prix'],2) ?> MAD</p>
<p style="color:green"><strong>N.B: Livraison gratuite</strong></p>

<?php if($message): ?>
  <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if($estDansPanier): ?>
    <button class="btn-commander" onclick="showPopup()">Commander</button>
<?php else: ?>
    <form method="post">
        <input type="hidden" name="ajouter" value="<?= $produit['id'] ?>">
        <button type="submit" class="btn-ajouter">Ajouter au panier</button>
    </form>
<?php endif; ?>

<!-- Bouton retour تحت الصورة والاسم -->
<!-- Bouton Retour avec redirection directe -->
<br><button class="bouton-retour" onclick="window.location.href='produits.php';">Retour</button>

<script>
function showPopup() {
    document.getElementById('popup-success').style.display='block';
}
</script>

</body>
</html>
