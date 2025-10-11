<?php 
include '../../VIEWS/admin_header.php';
require_once ('../../config/Database.php');
$database = new Database();
$conn = $database->getConnection();

$stmt = $conn->prepare("SELECT * FROM produit");
$stmt->execute();
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Gestion des Produits</title>

<!-- Font Awesome pour icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f9f9f9;
    color: #222;
}

 a {
      
      text-decoration: none;
  }
/* Contenu principal centré */
.main-content {
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;       /* centre horizontalement */
}

/* Titre */
h1 {
    text-align: center;
    margin-bottom: 30px;
}

/* Bouton Ajouter produit */
.btn-success {
    background:#fff; 
    border:1px solid #222; 
    padding:10px 20px; 
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
    transition:0.2s;
    color:#222;
    margin-bottom: 20px;
}
.btn-success:hover { background:#eee; }

/* Tableau produits */
.table-responsive {
    width: 70%;            /* largeur réduite */
    max-width: 900px;      /* limite largeur sur grand écran */
    overflow-x: auto;
}

table {
    width: 100%;           /* prend tout l’espace de .table-responsive */
    border-collapse: collapse;
    background:#fff;
    border-radius:6px;
    overflow: hidden;
}

thead {
    color: white;
    background: #007bff;
}

th, td {
    padding:12px 10px;
    text-align:center;
    border-bottom:1px solid #ccc;
}

tbody tr:hover {
    background:#f5f5f5;
    transition:0.2s;
}

/* Boutons Modifier / Supprimer */
.btn-warning, .btn-danger {
    background:#fff; 
    border:1px solid #aaa; 
    color:   #007bff;;
    padding:6px 10px; 
    border-radius:6px;
    cursor:pointer;
}

.btn-warning:hover, .btn-danger:hover {
    background:#eee;
}

/* Image produit */
img.product-img {
    width:60px;
    height:60px;
    object-fit:cover;
    border-radius:6px;
}

/* Responsive */
@media (max-width:768px){
    .table-responsive { width: 95%; }
    .btn-success { width: 100%; text-align: center; margin-bottom: 15px; }
}
</style>
</head>
<body>

<main class="main-content">
    <h1>Gestion des Produits</h1>

    <a style=" text-decoration: none; color: #2e639cff ;" href="ajouter_product.php" class="btn btn-success">
        <i class="fas fa-plus"></i> Ajouter un produit
    </a>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($produits)) : ?>
                <?php foreach($produits as $produit): ?>
                    <tr>
                        <td><?= htmlspecialchars($produit['id']) ?></td>
                        <td><?= htmlspecialchars($produit['nom']) ?></td>
                        <td><?= htmlspecialchars($produit['prix']) ?> MAD</td>
                        <td>
                            <img src="../../images/<?= htmlspecialchars($produit['image']) ?>" 
                                 alt="<?= htmlspecialchars($produit['nom']) ?>" 
                                 class="product-img">
                        </td>
                        <td>
                            <a href="modifier_products.php?id=<?= $produit['id'] ?>" 
                               class="btn btn-warning me-2">
                               <i class="fas fa-edit"></i> Modifier
                            </a>
                            <a href="supprimer_products.php?id=<?= $produit['id'] ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                               <i class="fas fa-trash-alt"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun produit trouvé</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
