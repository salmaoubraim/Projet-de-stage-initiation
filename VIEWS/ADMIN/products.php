<?php
require_once __DIR__.'/../../config/database.php';

class Product {
    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Lister tous les produits
    public function getProducts(){
        $stmt = $this->conn->prepare("SELECT * FROM produit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter produit
    public function addProduct($name, $price){
        $stmt = $this->conn->prepare("INSERT INTO produit (name, price) VALUES (:name, :price)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Modifier produit
    public function updateProduct($id, $name, $price){
        $stmt = $this->conn->prepare("UPDATE produit SET name=:name, price=:price WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Supprimer produit
    public function deleteProduct($id){
        $stmt = $this->conn->prepare("DELETE FROM produit WHERE id=:id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Compter produits
    public function countProducts(){
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM produit");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
