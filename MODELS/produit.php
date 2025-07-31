<?php
class Produit {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getProduits($limit = null) {
        $sql = "SELECT * FROM produits";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduitById($id) {
        $stmt = $this->db->prepare("SELECT * FROM produits WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
