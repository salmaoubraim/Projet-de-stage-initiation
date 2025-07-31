<?php
session_start();
include("../../VIEWS/headerr.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="style_registrer.css">
    <script src="script_homee.js" ></script>
      <link rel="stylesheet" href="style_home.css">
            <link rel="stylesheet" href="panierr.css">
  <link rel="stylesheet" href="style_loginn.css">

</head>
<body>
  <form action="" method="post">
    <fieldset>
      <legend><h1>Inscription</h1></legend>

      <label>Nom d'utilisateur:</label>
      <input type="text" name="nom_utilisateur" required><br><br>

      <label>Email :</label>
      <input type="email" name="email" required><br><br>

      <label>Mot de passe:</label>
      <input type="password" name="mot_de_passe" required><br><br>

      <button type="submit">S'inscrire</button>
    </fieldset>
  </form>
</body>
</html>
