<?php
session_start();
include("../../VIEWS/headerr.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // traitement...
    $_SESSION['success_message'] = "Merci ! Nous avons bien reçu votre message. Veuillez patienter, une réponse vous sera envoyée bientôt.";
    header("Location: contact.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
    <link rel="stylesheet" href="style_contact.css">
    <script src="script_homee.js" ></script>
       <link rel="stylesheet" href="panierr.css">
  <link rel="stylesheet" href="style_loginn.css">

</head>

<body>

<?php if (isset($_SESSION['success_message'])): ?>
  <!-- ✅ Modale -->
  <div id="successModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <p><?= $_SESSION['success_message'] ?></p>
    </div>
  </div>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<!-- ✅ Formulaire de contact -->
<fieldset>
  <legend><h2>Contactez-nous</h2></legend>
  <form method="post" action="contact.php">
    <label>Nom :</label>
    <input type="text" name="nom" required>

    <label>Email :</label>
    <input type="email" name="email" required>

    <label>Message :</label>
    <textarea name="message" rows="5" required></textarea>

    <input class="envoyer" type="submit"></input>
  </form>
</fieldset>

<script>
// عرض النافذة
window.onload = function() {
  var modal = document.getElementById('successModal');
  if (modal && modal.querySelector('p').textContent.trim() !== '') {
    modal.style.display = 'block';
  }
}

// إخفاء النافذة عند الضغط على زر الإغلاق
function closeModal() {
  document.getElementById('successModal').style.display = 'none';
}

// إخفاء النافذة عند الضغط خارج المحتوى
window.onclick = function(event) {
  var modal = document.getElementById('successModal');
  if (event.target === modal) {
    modal.style.display = 'none';
  }
}

</script>

</body>
</html>


