
<?php
// MODELS/Produit.php
require_once '../..config/Database.php';

class Produit {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM produit");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
