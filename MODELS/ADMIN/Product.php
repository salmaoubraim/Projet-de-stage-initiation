<?php
class Product {
    private $conn;
    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "electro_ecommerce");
    }

    public function getProducts() {
        $result = $this->conn->query("SELECT * FROM produit");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countProducts() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM produit");
        return $result->fetch_assoc()['total'];
    }
}
