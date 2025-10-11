<?php
require_once ("../../config/database.php");

class OrderModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllOrders() {
        $result = $this->conn->query("SELECT * FROM commande_speciale");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
