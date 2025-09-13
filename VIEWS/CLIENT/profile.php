<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_profile.css">
</head>
<body>
    <div class="profile-container">
        <h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['user']); ?> !</h1>
        <p>Voici votre profil.</p>
        <a href="logout.php">Déconnexion</a>
    </div>
</body>
</html>