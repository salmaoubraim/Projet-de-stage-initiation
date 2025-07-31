<?php
session_start();
require_once ('../../config/database.php');
require_once ('../../models/login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['nom_utilisateur'] ?? '';
    $password = $_POST['mot_de_passe'] ?? '';

    if (empty($username) || empty($password)) {
        die('Veuillez remplir tous les champs.');
    }

    // إنشاء اتصال بقاعدة البيانات
    $database = new Database();
    $db = $database->getConnection();

    $userModel = new User($db);

    // جلب المستخدم
    $stmt = $userModel->getUserByUsername($username);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // تحقق من كلمة السر (نفترض أنها مخزنة مشفرة بـ password_hash)
        if (password_verify($password, $user['mot_de_passe'])) {
            // تسجيل الدخول: حفظ بيانات المستخدم في الجلسة
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nom_utilisateur' => $user['nom_utilisateur'],
                'email' => $user['email']
            ];

            // إعادة توجيه لصفحة الرئيسية أو المنتجات
            header('Location: ../VIEWS/CLIENT/home.php');
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Nom d'utilisateur non trouvé.";
    }
} else {
    // ممنوع الدخول إلا عبر POST
    header('Location: ../VIEWS/CLIENT/login.php');
    exit;
}
