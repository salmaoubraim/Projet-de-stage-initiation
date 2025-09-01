<?php
session_start();
require_once '../../CONFIG/Database.php';
include("../../VIEWS/headerr.php");

$database = new Database();
$db = $database->getConnection();

// POST معالجة الفورم
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $produit = $_POST['produit'];
    $quantite = $_POST['quantite'];
    $adresse = $_POST['adresse'];
    $user_id = $_SESSION['user']['id'] ?? null;

    $stmt = $db->prepare("INSERT INTO commandes_speciales (username, user_id, nom_produit, quantite, adresse) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $user_id, $produit, $quantite, $adresse]);

    // لإظهار popup بعد الحفظ
    echo "<script>window.onload = function() { showSuccessPopup(); }</script>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nouvelle commande</title>
<link rel="stylesheet" href="style_commande.css">
  <link rel="stylesheet" href="panierr.css">
  <link rel="stylesheet" href="style_loginn.css">
  <script src="script_homee.js" ></script>
    <link rel="stylesheet" href="style_produits.css">
    

</head>
<body >

<fieldset>
   <legend><h1>Créer une nouvelle commande :</h1></legend>

   <form method="post" class="order-form">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>

        <label>Nom du produit :</label>
        <input type="text" name="produit" required>

        <label>Quantité :</label>
        <input type="number" name="quantite" min="1" required>

        <label>Adresse de livraison :</label>
        <textarea name="adresse" rows="4" required></textarea>

        <button style="font-size: 22px;" type="submit" class="envoyer">Commander</button>
   </form>
</fieldset>


<!-- POPUP SUCCESS -->
<div id="popup-success" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%); background-color:white; padding:20px; border:2px solid #88908b; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.3); z-index:9999; text-align:center;">
  <p style="font-weight:bold; color: green;">Votre commande a été effectuée avec succès ! </p>
    <p style="font-weight:bold; color: green;">Livraison prévue dans 2 jours. </p>
  <button onclick="document.getElementById('popup-success').style.display='none'" style="margin-top:10px; font-size: 18px; background-color: green; color:white; border:none; padding:8px 12px; border-radius:5px; cursor:pointer;">Fermer</button>
</div>

<script>
function showSuccessPopup() {
    document.getElementById('popup-success').style.display = 'block';
}
</script>

</body>
</html>
