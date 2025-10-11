<?php
include '../../VIEWS/admin_header.php';
include '../../config/database.php';

if (!isset($_GET['id'])) die("ID non spécifié");
$id = intval($_GET['id']);

$sql = "SELECT * FROM produit WHERE id=$id";
$res = $conn->query($sql);
$product = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    // Vérifier si une image a été uploadée
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../../images/" . $image_name);
    } else {
        $image_name = $product['image']; // conserver l'image existante
    }

    $stmt = $conn->prepare("UPDATE produit SET nom=:nom, prix=:prix, image=:image WHERE id=:id");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prix', $prix);
    $stmt->bindParam(':image', $image_name);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: produits.php?msg=Produit modifié");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Modifier Produit</title>
<style>
body { font-family:'Segoe UI',sans-serif; background:#f5f5f5; margin:0; padding:0;}
.form-container { display:flex; justify-content:center; align-items:center; min-height:calc(100vh - 80px); padding:20px;}
.form-card { background:#222; padding:40px; border-radius:20px; color:#fff; box-shadow:0 10px 25px rgba(0,0,0,0.5); width:100%; max-width:450px;}
.form-card h2 { text-align:center; margin-bottom:30px; font-weight:700;}
.form-card label { display:block; margin-bottom:8px; font-weight:600;}
.form-card input[type="text"],
.form-card input[type="number"],
.form-card input[type="file"] { width:100%; padding:12px 15px; margin-bottom:20px; border-radius:10px; border:none; background:white; color:black; box-shadow: inset 0 2px 5px rgba(0,0,0,0.5); transition:0.3s; }
.form-card input:focus { outline:none; box-shadow:0 0 10px #0d6efd; background:#1a1a1a; color:white; }
.form-card button { width:100%; padding:12px; border-radius:10px; border:none; background:#0d6efd; color:#fff; font-weight:600; cursor:pointer; transition:0.3s; margin-bottom:10px;}
.form-card button:hover { background:#0b5ed7; }
.btn-secondary { background:#6c757d; }
.btn-secondary:hover { background:#5a6268; }
</style>
</head>
<body>
<div class="form-container">
  <div class="form-card">
      <h2>Modifier Produit</h2>
      <form method="POST" enctype="multipart/form-data">
          <label>Nom du Produit</label>
          <input type="text" name="nom" value="<?= htmlspecialchars($product['nom']) ?>" required>

          <label>Prix (MAD)</label>
          <input type="number" name="prix" value="<?= htmlspecialchars($product['prix']) ?>" required>

          <label>Image</label>
          <input type="file" name="image" accept="image/*">
          <?php if(!empty($product['image'])): ?>
            <p>Image actuelle: <img src="../../images/<?= htmlspecialchars($product['image']) ?>" alt="Produit" style="width:80px; display:block; margin-top:10px; border-radius:5px;"></p>
          <?php endif; ?>

          <button type="submit">Modifier</button>
          <a href="products.php"><button style="background: #6c757d;" type="button" class="btn-secondary">Annuler</button></a>
      </form>
  </div>
</div>
</body>
</html>
