<?php
class Order {
    private $conn;
    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "electro_ecommerce");
    }

    public function getOrders() {
        $result = $this->conn->query("SELECT * FROM commande_speciale");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countOrders() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM commande_speciale");
        return $result->fetch_assoc()['total'];
    }
}
