<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once __DIR__ . '/../../MODELS/ADMIN/Product.php';
require_once __DIR__ . '/../../MODELS/ADMIN/Order.php';
require_once __DIR__ . '/../../MODELS/ADMIN/User.php';

$product = new Product();
$order = new Order();
$user = new User();

$countProducts = $product->countProducts();
$countOrders = $order->countOrders();
$countUsers = count($user->getUsers());
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style_admin.css">
</head>
<body>
<div class="dashboard-container">
    <header>
        <h2>Bienvenue, <?php echo $_SESSION['admin']; ?></h2>
        <a href="../../CONTROLLERS/ADMIN/AdminController.php?action=logout" class="btn-logout">Déconnexion</a>
    </header>
    <div class="stats">
        <div class="card">Produits: <?php echo $countProducts; ?></div>
        <div class="card">Commandes: <?php echo $countOrders; ?></div>
        <div class="card">Utilisateurs: <?php echo $countUsers; ?></div>
    </div>
</div>
</body>
</html>
