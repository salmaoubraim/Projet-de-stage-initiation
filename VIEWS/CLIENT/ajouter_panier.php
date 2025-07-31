<?php
session_start();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = []; // format: ['id_produit' => quantité]
}

if (isset($_GET['id'])) {
    $idProduit = intval($_GET['id']);

    if (isset($_SESSION['panier'][$idProduit])) {
        $_SESSION['panier'][$idProduit]++;
    } else {
        $_SESSION['panier'][$idProduit] = 1;
    }

    $count = array_sum($_SESSION['panier']); // total quantité
    echo json_encode(['success' => true, 'count' => $count]);
    exit;
}

echo json_encode(['success' => false]);
