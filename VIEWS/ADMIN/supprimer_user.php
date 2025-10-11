<?php
include '../../VIEWS/admin_header.php';
include '../../config/database.php';

if (!isset($_GET['id'])) die("ID non spécifié");
$id = intval($_GET['id']);

$sql = "SELECT * FROM user WHERE id=$id";
$res = $conn->query($sql);
$user = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $conn->query("UPDATE user SET nom='$nom', email='$email' WHERE id=$id");
    header("Location: users.php?msg=Utilisateur modifié");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Modifier Utilisateur</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.container-center { max-width:600px; margin:50px auto; }
.card { padding:30px; border-radius:12px; box-shadow:0 10px 25px rgba(0,0,0,0.15);}
</style>
</head>
<body>
<div class="container-center">
  <div class="card">
    <div class="card-header bg-warning text-white">
      <h4>Modifier Utilisateur</h4>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nom</label>
          <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($user['nom']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary">Modifier</button>
          <a href="users.php" class="btn btn-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
