<?php
class TestimonyController {
    public function index() {
        session_start();

        // Ajouter un témoignage
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars($_POST['nom']);
            $message = htmlspecialchars($_POST['message']);

            $_SESSION['temoignages'][] = [
                'nom' => $nom,
                'message' => $message
            ];
        }

        include './views/testimony.php';
    }
}
