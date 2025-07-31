<?php
session_start();
include_once('../../config/database.php');

$database = new Database();
$conn = $database->getConnection();

// معالجة إرسال التعليق
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $commentaire = trim($_POST['commentaire'] ?? '');

    if ($nom !== '' && $commentaire !== '') {
        $stmt = $conn->prepare("INSERT INTO commentaires (nom, commentaire, date) VALUES (?, ?, NOW())");
        $stmt->execute([$nom, $commentaire]);
        header("Location: testimony.php"); // إعادة تحميل الصفحة بعد الإرسال
        exit;
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

// جلب كل التعليقات
$stmt = $conn->prepare("SELECT * FROM commentaires ORDER BY date DESC");
$stmt->execute();
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<title>Témoignages</title>

<link rel="stylesheet" href="style_testimony.css">
  <script src="script_homee.js" ></script>
    <link rel="stylesheet" href="style_login.css">
          <link rel="stylesheet" href="panierr.css">
  <link rel="stylesheet" href="style_home.css">

</head>
<body>

<?php include("../../VIEWS/headerr.php"); ?>

<fieldset>
    <legend style="text-align:center;" >Laisser un témoignage</legend>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="testimony.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="commentaire">Votre témoignage :</label>
        <textarea name="commentaire" id="commentaire" rows="4" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</fieldset>

<h2 style="text-align:center; margin-bottom: 20px;">Tous les témoignages</h2>

<?php if ($commentaires): ?>
    <?php foreach ($commentaires as $com): ?>
        <div class="commentaire">
            <strong><?= htmlspecialchars($com['nom']) ?></strong>
            <small><?= date('d/m/Y H:i', strtotime($com['date'])) ?></small>
            <p><?= nl2br(htmlspecialchars($com['commentaire'])) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">Aucun témoignage pour le moment.</p>
<?php endif; ?>

</body>
</html>
