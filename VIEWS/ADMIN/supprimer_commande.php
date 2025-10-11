<?php
include '../../config/database.php';

if (!isset($_GET['id'])) die("ID non spécifié");

$id = intval($_GET['id']);

// Supprimer la commande
$conn->query("DELETE FROM commande_speciale WHERE id=$id");

// Redirection vers la page principale des commandes avec message
header("Location: order.php?msg=Commande supprimée");
exit;
