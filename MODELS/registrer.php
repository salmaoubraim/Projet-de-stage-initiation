<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $nom_utilisateur;
    public $email;
    public $mot_de_passe;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getUserByUsername($nom_utilisateur) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nom_utilisateur = :nom_utilisateur LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->execute();
        return $stmt;
    }
}
