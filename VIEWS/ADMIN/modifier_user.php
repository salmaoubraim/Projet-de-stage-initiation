<?php
include '../../VIEWS/admin_header.php';
include '../../config/database.php';

if (!isset($_GET['id'])) die("ID non spécifié");
$id = intval($_GET['id']);

$sql = "SELECT * FROM admins WHERE id=$id";
$res = $conn->query($sql);
$user = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("UPDATE user SET nom=:nom, email=:email WHERE id=:id");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

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
<style>
body { font-family:'Segoe UI',sans-serif; background:#f5f5f5; margin:0; padding:0;}
.form-container { display:flex; justify-content:center; align-items:center; min-height:calc(100vh - 80px); padding:20px;}
.form-card { background:#222; padding:40px; border-radius:20px; color:#fff; box-shadow:0 10px 25px rgba(0,0,0,0.5); width:100%; max-width:450px;}
.form-card h2 { text-align:center; margin-bottom:30px; font-weight:700;}
.form-card label { display:block; margin-bottom:8px; font-weight:600;}
.form-card input { width:100%; padding:12px 15px; margin-bottom:20px; border-radius:10px; border:none; background:white; color:black; box-shadow: inset 0 2px 5px rgba(0,0,0,0.5); transition:0.3s; }
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
      <h2>Modifier Utilisateur</h2>
      <form method="POST">
          <label>Nom</label>
          <input type="text" name="nom" value="<?= htmlspecialchars($user['nom_utilisateur']) ?>" required>

          <label>Email</label>
          <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

          <button type="submit">Modifier</button>
          <a href="user.php"><button style="background: #6c757d;" type="button" class="btn-secondary">Annuler</button></a>
      </form>
  </div>
</div>
</body>
</html>
