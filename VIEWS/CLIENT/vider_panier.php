<?php
session_start();

// نحيد السلة
unset($_SESSION['panier']);

// نرجعو مباشرة للمنتجات
header("Location: produits.php");
exit();
