<?php
session_start();
include '../../config/database.php'; // chemin vers ton fichier Database.php

// Créer connexion
$database = new Database();
$conn = $database->getConnection(); // $conn daba défini

if(isset($_POST['email'], $_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if($admin && $password === $admin['password']) { // ou password_verify si hash
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        header("Location: ../../VIEWS/ADMIN/dashboard.php");
        exit;
    } else {
        header("Location: ../../views/login.php?error=Email ou mot de passe incorrect");
        exit;
    }
}
