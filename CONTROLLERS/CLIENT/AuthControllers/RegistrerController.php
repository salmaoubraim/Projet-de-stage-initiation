<?php
session_start();
require_once '../config/Database.php';
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['nom_utilisateur'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['mot_de_passe'] ?? '';

    // تحقق من تعبئة الحقول
    if (empty($username) || empty($email) || empty($password)) {
        die('Tous les champs sont obligatoires.');
    }

    // تحقق من صحة الإيميل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Email invalide.');
    }

    // إنشاء اتصال بقاعدة البيانات
    $database = new Database();
    $db = $database->getConnection();

    $userModel = new User($db);

    // تحقق إذا كان اسم المستخدم أو الإيميل موجود مسبقاً
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE nom_utilisateur = :username OR email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        die('Nom d\'utilisateur ou email déjà utilisé.');
    }

    // تشفير كلمة السر
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // إدخال المستخدم في قاعدة البيانات
    $insertQuery = "INSERT INTO users (nom_utilisateur, email, mot_de_passe) VALUES (:username, :email, :password)";
    $stmtInsert = $db->prepare($insertQuery);
    $stmtInsert->bindParam(':username', $username);
    $stmtInsert->bindParam(':email', $email);
    $stmtInsert->bindParam(':password', $hashedPassword);

    if ($stmtInsert->execute()) {
        // تسجيل ناجح، يمكنك توجيه المستخدم لتسجيل الدخول أو الصفحة الرئيسية
        header('Location: ../VIEWS/CLIENT/login.php?register=success');
        exit;
    } else {
        die('Erreur lors de l\'inscription.');
    }
} else {
    // ممنوع الدخول إلا عبر POST
    header('Location: ../VIEWS/CLIENT/registrer.php');
    exit;
}
