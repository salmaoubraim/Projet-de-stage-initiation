<?php 
session_start();
include("../../VIEWS/headerr.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>À propos - ElectroShop</title>
<link rel="stylesheet" href="style_homee.css">
<link rel="stylesheet" href="style_loginn.css">
<link rel="stylesheet" href="panierr.css">
<style>
/* Conteneur principal */
.infos-container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
    display: flex;
    flex-direction: column;
    gap: 40px;
}

/* Section introduction */
.intro {
    text-align: center;
}

.intro h1 {
    font-size: 36px;
    margin-bottom: 40px;
    color: white;
}

.intro p {
    font-size: 18px;
    line-height: 1.6;
    color: white;
    margin-bottom: 15px;
}

.intro-buttons {
    margin-top: 20px;
}

.intro-buttons button {
    background-color: #88908b;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    margin: 5px;
    transition: background 0.3s ease;
    color: white;
}

.intro-buttons button:hover {
    background-color: transparent;
}

/* Section services / avantages */
.services {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    color: black;
}

.service-card {
    flex: 1 1 250px;
    background: #f5f5f5;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    transition: transform 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
}

.service-card h3 {
    font-size: 20px;
    margin-bottom: 10px;
}

.service-card p {
    font-size: 16px;
    color: #555;
}



/* Responsive */
@media (max-width: 768px) {
    .services {
        flex-direction: column;
        align-items: center;
    }

    .intro-buttons {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
}
</style>
</head>
<body>

<div class="infos-container">

    <!-- Section introduction -->
    <div class="intro">
        <h1>Bienvenue chez ElectroShop</h1>
        <p>Nous proposons les meilleurs produits électroniques à des prix compétitifs. Notre objectif est de garantir une expérience d'achat simple et agréable.</p>
        <p>Notre équipe sélectionne chaque produit avec soin pour assurer qualité et fiabilité.</p>
        <div class="intro-buttons">
            <button onclick="window.location.href='produits.php'">Voir nos produits</button>
            <button onclick="window.location.href='contact.php'">Contactez-nous</button>
        </div>
    </div>

    <!-- Section services / avantages -->
    <div class="services">
        <div class="service-card">
            <h3>Livraison rapide</h3>
            <p>Recevez vos produits en un temps record, directement chez vous.</p>
        </div>
        <div class="service-card">
            <h3>Produits de qualité</h3>
            <p>Nous garantissons la qualité de chaque produit que nous vendons.</p>
        </div>
        <div class="service-card">
            <h3>Service client 24/7</h3>
            <p>Notre équipe est disponible à tout moment pour vous aider.</p>
        </div>
        <div class="service-card">
            <h3>Retours faciles</h3>
            <p>Vous n'êtes pas satisfait ? Retournez facilement vos produits.</p>
        </div>
    </div>

</div>

</body>
</html>
