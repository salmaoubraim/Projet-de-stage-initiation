<?php
require_once '../../MODELS/Product.php';
require_once '../../config/database.php';

$productModel = new ProductModel($db);

if (isset($_GET['action'])) {
    if ($_GET['action'] === "add" && $_SERVER['REQUEST_METHOD'] === "POST") {
        $productModel->create($_POST['nom'], $_POST['prix'], $_FILES['image']['name'], $_POST['description']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);
        header("Location: ../VIEWS/ADMIN/products.php");
    }

    if ($_GET['action'] === "delete" && isset($_GET['id'])) {
        $productModel->delete($_GET['id']);
        header("Location: ../MODELS/ADMIN/Product.php");
    }
}
