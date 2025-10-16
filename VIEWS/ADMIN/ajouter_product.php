<?php
include '../../VIEWS/admin_header.php';
include '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../../images/" . $image_name);
    } else {
        $image_name = null;
    }

$stmt = $conn->prepare("INSERT INTO produit (nom, prix, image) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $nom, $prix, $image_name); 
// s = string, d = double (decimal), s = string
$stmt->execute();


    header("Location: products.php?msg=Produit ajouté avec succès");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ajouter Produit</title>
<style>
body { 
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
     background: white;
      margin: 0;
      padding: 0; }

/* Container centré */
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 80px); /* Pour header */
    padding: 20px;
}

/* Card formulaire */
.form-card {
    background: #222;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    width: 100%;
    max-width: 450px;
    color: #fff;
    transition: 0.3s;
}

.form-card h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
}

/* Labels */
.form-card label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #fff;
}

/* Inputs text / number / file */
.form-card input[type="text"],
.form-card input[type="number"],
.form-card input[type="file"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #444;
    background: white;
    color: black;
    box-shadow: inset 0 2px 5px rgba(0,0,0,0.5);
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-card input:focus {
    outline: none;
    background: white;
    border: 1px solid #0d6efd;
    box-shadow: 0 0 10px #0d6efd;
}

/* Buttons primary */
.form-card button {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    background: #0d6efd;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    margin-bottom: 10px;
}

.form-card button:hover {
    background: #0b5ed7;
}

/* Button secondaire */
.form-card .btn-secondary {
    background: #6c757d;
    color: #fff;
}

.form-card .btn-secondary:hover {
    background: #5a6268;
}

/* Placeholder color */
.form-card input::placeholder {
    color: #aaa;
}

/* Small responsive tweaks */
@media (max-width: 500px) {
    .form-card {
        padding: 30px 20px;
    }
    .form-card h2 {
        font-size: 22px;
    }
    .form-card input[type="text"],
    .form-card input[type="number"],
    .form-card input[type="file"] {
        font-size: 14px;
        padding: 10px 12px;
    }
    .form-card button {
        font-size: 14px;
        padding: 10px;
    }
}

</style>
</head>
<body>
<div class="form-container">
  <div class="form-card">
      <h2>Ajouter un Produit</h2>
      <form method="POST" enctype="multipart/form-data">
          <label>Nom du Produit</label>
          <input type="text" name="nom" placeholder="Nom du produit" required>

          <label>Prix (MAD)</label>
          <input type="number" name="prix" placeholder="Prix" required min="0" step="50">

          <label>Image</label>
          <input type="file" name="image" accept="image/*">

          <button type="submit">Ajouter</button>
          <a href="produits.php"><button type="button" class="btn-secondary">Annuler</button></a>
      </form>
  </div>
</div>
</body>
</html>
