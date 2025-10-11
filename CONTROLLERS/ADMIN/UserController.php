<?php
require_once __DIR__ . '/../MODELS/UserModel.php';
require_once __DIR__ . '/../config/database.php';

$userModel = new UserModel($db);

if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['id'])) {
    $userModel->delete($_GET['id']);
    header("Location: ../VIEWS/ADMIN/user.php");
}
