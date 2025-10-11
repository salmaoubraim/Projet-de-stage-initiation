<?php
class CommentModel {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM commentaire ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
}
