<?php
require_once('../../config/Database.php');
include('../../VIEWS/admin_header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = trim($_POST['nom_utilisateur']);
    $email = trim($_POST['email']);
    $password = trim($_POST['mot_de_passe']);

    if (!empty($nom_utilisateur) && !empty($email) && !empty($password)) {

        // ✅ ما ندخلوش id، حيث AUTO_INCREMENT
        $stmt = $conn->prepare("INSERT INTO user (nom_utilisateur, email, mot_de_passe, created_at) VALUES (?, ?, ?, NOW())");

        if ($stmt === false) {
            die("Erreur dans la préparation : " . $conn->error);
        }

        // ✅ النوع "sss" حيث عندنا 3 valeurs (string, string, string)
        $stmt->bind_param("sss", $nom_utilisateur, $email, $password);

        if ($stmt->execute()) {
            header("Location: user.php?msg=Utilisateur ajouté avec succès");
            exit;
        } else {
            $error = "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ajouter Utilisateur</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
}
.form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(100vh - 80px);
    padding: 20px;
}
.form-card {
    background: #222;
    padding: 40px;
    border-radius: 20px;
    color: #fff;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    width: 100%;
    max-width: 450px;
}
.form-card h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
    color: white;
}
.form-card label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
}
.form-card input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: none;
    box-shadow: inset 0 2px 5px rgba(0,0,0,0.5);
    transition: 0.3s;
}
.form-card input:focus {
    outline: none;
    box-shadow: 0 0 10px #0d6efd;
}
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
.btn-secondary {
    background: #6c757d;
}
.btn-secondary:hover {
    background: #5a6268;
}
.error {
    background: rgba(255,0,0,0.1);
    color: #ff8080;
    border-left: 4px solid #ff4d4d;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    text-align: center;
}
</style>
</head>
<body>

<div class="form-container">
  <div class="form-card">
      <h2>Ajouter un utilisateur</h2>

      <?php if (!empty($error)) : ?>
          <div class="error"><?= $error ?></div>
      <?php endif; ?>

      <form method="POST">
          <label>Nom d'utilisateur</label>
          <input type="text" name="nom_utilisateur" placeholder="Entrez le nom..." required>

          <label>Email</label>
          <input type="email" name="email" placeholder="Entrez l'email..." required>

          <label>Mot de passe</label>
          <input type="password" name="mot_de_passe" placeholder="Entrez le mot de passe..." required>

          <button type="submit">Ajouter</button>
          <a href="user.php"><button type="button" class="btn-secondary">Annuler</button></a>
      </form>
  </div>
</div>

</body>
</html>
