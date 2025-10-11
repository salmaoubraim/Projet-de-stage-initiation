<?php
// CONTROLLERS/ADMIN/AdminController.php
require_once __DIR__ . '/../../MODELS/ADMIN/Product.php';

class AdminController {
    public function produits() {
        $produitModel = new Produit();
        $produits = $produitModel->getAll();

        include __DIR__ . '../../VIEWS/ADMIN/products.php';
    }
}
?>