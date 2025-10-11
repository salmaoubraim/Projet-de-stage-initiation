<?php
include '../../VIEWS/admin_header.php';
include '../../config/database.php';

if (!isset($_GET['id'])) die("ID non spécifié");
$id = intval($_GET['id']);

$sql = "SELECT * FROM commande_speciale WHERE id=$id";
$res = $conn->query($sql);
$order = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Voir Commande</title>
<style>
body { font-family:'Segoe UI',sans-serif; background:#f5f5f5; margin:0; padding:0;}
.container { display:flex; justify-content:center; align-items:center; min-height:calc(100vh - 80px);}
.card { background:#222; padding:40px; border-radius:20px; color:#fff; box-shadow:0 10px 25px rgba(0,0,0,0.5); width:100%; max-width:500px;}
.card h2 { text-align:center; margin-bottom:20px;}
.card p { margin-bottom:15px; font-weight:600;}
.btn { width:100%; padding:12px; border-radius:10px; border:none; background:#0d6efd; color:#fff; font-weight:600; cursor:pointer; text-align:center; display:block; text-decoration:none;}
.btn:hover { background:#0b5ed7; }
</style>
</head>
<body>
<div class="container">
  <div class="card">
      <h2>Détails Commande #<?= $order['id'] ?></h2>
      <p><b>Utilisateur:</b> <?= htmlspecialchars($order['username']) ?></p>
      <p><b>Produit:</b> <?= htmlspecialchars($order['nom_produit']) ?></p>
      <p><b>Quantité:</b> <?= htmlspecialchars($order['quantite']) ?></p>
      <p><b>Adresse:</b> <?= htmlspecialchars($order['adresse']) ?></p>
      <p><b>Status:</b> <?= htmlspecialchars($order['status']) ?></p>
      <p><b>Date:</b> <?= htmlspecialchars($order['date_commande']) ?></p>
      <a href="order.php" class="btn">⬅ Retour</a>
  </div>
</div>
</body>
</html>
