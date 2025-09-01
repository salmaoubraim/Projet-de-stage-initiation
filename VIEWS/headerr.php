<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_loginn.css">
    <link rel="stylesheet" href="style_homee.css">
    <link rel="stylesheet" href="panierr.css">
    <link rel="stylesheet" href="header.css">
</head> 
<body>  
<header>
    
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
                        <a href="register.php" >Register</a>
                        <a href="login.php">Login</a>
                        <a href="contact.php" >Contact</a>
                        <a href="infos.php" >Infos</a>
                        <a href="testimony.php" >Testimony</a>
                         </div>
             </div>

            <nav class="menu">
        </div>
        <div  class="right">
            
            <a  id="sa" style="color:white" href="home.php">Home</a>
            <a  id="sa" style="color:white" href="produits.php">Produits</a>
            <a id="sa" style="color:white" href="infos.php">À propos</a>
            <a  id="sa" style="color:white" href="contact.php">Contact</a>
        </div>
       <style>

</style>

    </div>

    <div class="login-button">
  <div class="dropdown">
    <?php if (isset($_SESSION['user'])): ?>
      <!-- 👤 زر البروفايل -->
      <button style="background:transparent; font-size: 18px; margin-right: 20px;  padding: 6px 12px; font-weight: bold;" class="dropbtn">👤 <?php echo htmlspecialchars($_SESSION['user']); ?></button>
      <div class="dropdown-content">
        <form action="profile.php" method="post" style="margin: 0;">
        <button  class="link-button">Mon Profile</button>
        </form>
          </div>
    <?php else: ?>
      <!-- زر Se connecter -->
      <button style="font-weight: bold;" class="dropbtn">Se connecter</button>
      <div class="dropdown-content">
        <form action="login.php" method="post" style="margin: 0;">
          <button type="submit" class="link-button">Sign In</button>
        </form>
        <form action="register.php" method="post" style="margin: 0;">
          <button type="submit" class="link-button">Sign Up</button>
        </form>
      </div>
    <?php endif; ?>
  </div>
</div>

    <?php

$cartCount = isset($_SESSION['panier']) ? array_sum($_SESSION['panier']) : 0;
?>
<a href="panier.php" class="panier-link">🛒 Panier (<span id="cart-count"><?php echo $cartCount; ?></span>)</a>
    </header>
    </body>
</html>
  
   










