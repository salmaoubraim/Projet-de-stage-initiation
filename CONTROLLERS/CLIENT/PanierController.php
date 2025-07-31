<?php
session_start();

class PanierController {
    public function ajouter($idProduit) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (!in_array($idProduit, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $idProduit;
        }

        // ترجع عدد المنتجات في السلة
        return count($_SESSION['panier']);
    }
}
