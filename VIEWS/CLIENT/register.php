<?php
session_start();
require_once("../../config/database.php");
include("../../VIEWS/headerr.php"); 

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = isset($_POST['nom_utilisateur']) ? trim($_POST['nom_utilisateur']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $motDePasse = isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : "";

    if($nom && $email && $motDePasse) {
        $password = password_hash($motDePasse, PASSWORD_BCRYPT);

        $check = $conn->prepare("SELECT id FROM user WHERE email = ?");
        $check->execute([$email]);

        if($check->rowCount() > 0) {
            $_SESSION['message'] = "⚠️ Cet email est déjà utilisé";
            $_SESSION['type'] = "error";
        } else {
            $stmt = $conn->prepare("INSERT INTO user (nom_utilisateur, email, mot_de_passe) VALUES (?, ?, ?)");
            if($stmt->execute([$nom, $email, $password])) {
                $_SESSION['message'] = "✅ Inscription réussie !";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['message'] = "❌ Erreur lors de l'inscription";
                $_SESSION['type'] = "error";
            }
        }
    } else {
        $_SESSION['message'] = "❌ Veuillez remplir tous les champs !";
        $_SESSION['type'] = "error";
    }

    header("Location: register.php");
    exit;
}

// Affichage du message depuis session
$message = $_SESSION['message'] ?? "";
$type = $_SESSION['type'] ?? "";
unset($_SESSION['message'], $_SESSION['type']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Inscription</title>
<style>
.popup { display: none; position: fixed; top:30%; left:50%; transform: translate(-50%, -50%); background:white; padding:20px; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.3); text-align:center; z-index:9999; }
.popup.success p { color:green; font-weight:bold; }
.popup.error p { color:red; font-weight:bold; }
.popup button { margin-top:10px; padding:8px 12px; border:none; border-radius:5px; cursor:pointer; color:white; }
.popup.success button { background:green; }
.popup.error button { background:red; }
</style>
  <link rel="stylesheet" href="style_loginn.css">
    <link rel="stylesheet" href="style_registrer.css">
        <link rel="stylesheet" href="style_produits.css">
    <script src="script_homee.js" ></script>
      <link rel="stylesheet" href="style_home.css">
      
</head>
<body>
<form style="margin-top:50px;" method="post">
    <fieldset>
        <legend style="font-size:30px;">Inscription</legend>
        <label>Nom d'utilisateur:</label>
        <input type="text" name="nom_utilisateur" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <label>Mot de passe:</label>
        <input type="password" name="mot_de_passe" required><br><br>
        <button type="submit">S'inscrire</button>
    </fieldset>
</form>

<?php if($message): ?>
<div class="popup <?= $type ?>" id="popup-message">
    <p><?= $message ?></p>
    <button onclick="document.getElementById('popup-message').style.display='none'">Fermer</button>
</div>
<script>
document.getElementById('popup-message').style.display = 'block';
setTimeout(()=>{ document.getElementById('popup-message').style.display='none'; }, 4000);
</script>
<?php endif; ?>
</body>
</html>
