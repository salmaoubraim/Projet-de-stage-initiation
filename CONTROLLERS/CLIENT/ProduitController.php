<?php
require_once 'models/produit.php';

class ProduitController {
    private $produit;

    public function __construct($db) {
        $this->produit = new Produit($db);
    }

    public function afficherProduits($limit = 6) {
        $produits = $this->produit->getProduits($limit);
        require 'views/client/produits.php';
    }

    public function afficherDetailsProduit($id) {
        $produit = $this->produit->getProduitById($id);
        require 'views/client/detail_produit.php';
    }
}
