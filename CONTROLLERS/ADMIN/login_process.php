<?php
session_start();
include '../../config/database.php'; // chemin vers ton fichier Database.php

// Créer connexion
$database = new Database();
$conn = $database->getConnection(); // $conn défini

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier l'admin
    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && $password === $admin['password']) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_email'] = $email;
    $_SESSION['nom_utilisateur'] = $admin['nom_utilisateur']; // هاد السطر ضروري
    header("Location: ../../VIEWS/ADMIN/dashboard.php");
    exit;
}else {
        header("Location: ../../VIEWS/login.php?error=Email ou mot de passe incorrect");
        exit;
    }
}
