<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_loginn.css">
    <link rel="stylesheet" href="style_homee.css">
    <link rel="stylesheet" href="panierr.css">
</head>
<body>  
<header>
  <div class="login-button">
    <div class="dropdown">
        <button class="dropbtn">Se connecter</button>
       <div class="dropdown-content">
    <?php if (isset($_SESSION['user'])): ?>
        <form action="logout.php" method="post" style="margin: 0;">
            <button type="submit" class="link-button">Log Out</button>
        </form>
    <?php else: ?>
        <form action="login.php" method="post" style="margin: 0;">
            <button type="submit" class="link-button">Sign In</button>
        </form>

        <form action="registrer.php" method="post" style="margin: 0;">
            <button type="submit" class="link-button">Sign Up</button>
        </form>
    <?php endif; ?>
    </div>
    </div>
</div>
        <div class="left">
            <div style="color:white" class="project-name">ElectroShop</div>
                <div   style="color:white" class="menu-toggle">
                    <div class="hamburger" onclick="toggleMenu()">☰</div>
                    <div id="menu-links" class="menu-links">
                        <a href="home.php" >Home</a> 
                        <a href="produits.php" >Produits</a>
                        <a href="panier.php" >Panier</a>
                        <a href="detail_produit.php" >Details_produits</a>
                        <a href="commande.php" >Commande</a>
                        <a href="registrer.php" >Registrer</a>
                        <a href="login.php">Login</a>
                        <a href="contact.php" >Contact</a>
                        <a href="infos.php" >Infos</a>
                        <a href="testimony.php" >Testimony</a>
                         </div>
             </div>

            <nav class="menu">
        </div>
        <div class="right">
            
            <a  id="sa" style="color:white" href="home.php">Home</a>
            <a  id="sa" style="color:white" href="produits.php">Produits</a>
            <a id="sa" style="color:white" href="infos.php">À propos</a>
            <a  id="sa" style="color:white" href="contact.php">Contact</a>
        </div>
       <style>

</style>

    </div>


    <?php

$cartCount = isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0;
?>

<a href="panier.php" class="panier-link">🛒 Panier (<span id="cart-count"><?php echo $cartCount; ?></span>)</a>
    </header>
    </body>
</html>

