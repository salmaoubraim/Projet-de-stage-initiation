
<?php $cartCount = 0; 
include("../../VIEWS/headerr.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script_homee.js" ></script>
      <link rel="stylesheet" href="style_commande.css">
            <link rel="stylesheet" href="panierr.css">
  <link rel="stylesheet" href="style_loginn.css">
</head>
<body>
    
</body>
</html>
<fieldset>
   <legend> <h1>Créer une nouvelle commande :</h1></legend>
   <form method="post" class="order-form">
    <label>Nom du produit :</label>
    <input type="text" name="produit" required>

    <label>Quantité :</label>
    <input type="number" name="quantite" min="1" required>

    <label>Adresse de livraison :</label>
    <textarea name="adresse" rows="4" required></textarea>

    <input type="submit" class="envoyer" ></input>
</form>
</form>
</fieldset>



