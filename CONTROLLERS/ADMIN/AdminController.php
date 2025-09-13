<?php
session_start();
require_once __DIR__ . '/../../MODELS/ADMIN/User.php';

$action = $_GET['action'] ?? '';

if($action == 'login'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    if($user->loginAdmin($email, $password)){
        $_SESSION['admin'] = $email;
        header("Location: ../../VIEWS/ADMIN/dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect";
        header("Location: ../../VIEWS/ADMIN/login.php");
        exit();
    }
}

if($action == 'logout'){
    session_destroy();
    header("Location: ../../VIEWS/ADMIN/login.php");
    exit();
}
