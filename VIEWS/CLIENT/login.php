<?php
session_start();
include("../../config/database.php");
include("../../VIEWS/headerr.php");
$db = new Database();
$conn = $db->getConnection();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // تحقق أولاً واش كاينين المفاتيح
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
    $password = isset($_POST["mot_de_passe"]) ? $_POST["mot_de_passe"] : null;

    if ($email && $password) {
        // نبحث عن المستخدم بالـ email
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // تحقق من كلمة السر
            if (password_verify($password, $user["mot_de_passe"])) {
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
  <title>Inscription</title>
  <link rel="stylesheet" href="style_loginn.css">
    <link rel="stylesheet" href="style_registrer.css">
        <link rel="stylesheet" href="style_produits.css">
    <script src="script_homee.js" ></script>
      <link rel="stylesheet" href="style_home.css">
      

</head>
<body>
  <form style="margin-top:50px;" action="" method="post">
    <fieldset>
      <legend><h1>Connection</h1></legend>

      <label>Email :</label>
      <input type="email" name="email" required><br><br>

      <label>Mot de passe:</label>
      <input type="password" name="mot_de_passe" required><br><br>

      <button style="font-size: 20px;" type="submit">S'inscrire</button>
    </fieldset>
  </form>
</body>
</html>  