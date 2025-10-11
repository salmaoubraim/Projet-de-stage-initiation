<?php
session_start();
include("../../config/database.php"); // adjust path
include("../../VIEWS/headerr.php");

$db = new Database();
$conn = $db->getConnection();

$message = "";

// POST handler
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
    $password = isset($_POST["mot_de_passe"]) ? $_POST["mot_de_passe"] : null;

    if ($email && $password) {

        // fetch user
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // TEMP: plain password check
            if ($password === $user["mot_de_passe"]) {
                $_SESSION["user"] = $user["nom_utilisateur"];
                $_SESSION["user_id"] = $user["id"];
                header("Location: home.php?login=success");
                exit;
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Email introuvable.";
        }

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Se connecter</title>
  <link rel="stylesheet" href="style_loginn.css">
  <link rel="stylesheet" href="style_registrer.css">
  <link rel="stylesheet" href="style_produits.css">
  <link rel="stylesheet" href="style_home.css">
  <script src="script_homee.js"></script>
</head>
<body>

  <form style="margin-top:50px;" action="" method="post">
    <fieldset>
      <legend><h1>Se connecter</h1></legend>

      <?php if ($message): ?>
        <p style="color:red;"><?php echo $message; ?></p>
      <?php endif; ?>

      <label>Email :</label>
      <input type="email" name="email" required><br><br>

      <label>Mot de passe :</label>
      <input type="password" name="mot_de_passe" required><br><br>

      <button style="font-size: 20px;" type="submit">Se connecter</button>
    </fieldset>
  </form>

</body>
</html>
