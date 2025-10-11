<?php
class UserModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM user ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM user WHERE id=?");
        return $stmt->execute([$id]);
    }
}
