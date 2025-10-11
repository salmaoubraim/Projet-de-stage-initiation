<?php
include '../../config/database.php';
if (!isset($_GET['id'])) die("ID non spécifié");

$id = intval($_GET['id']);
$conn->query("DELETE FROM produit WHERE id=$id");
header("Location: products.php?msg=Produit supprimé");
exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
            <link rel="stylesheet" href="admin.css">

</head>
<body>
    
</body>
</html>