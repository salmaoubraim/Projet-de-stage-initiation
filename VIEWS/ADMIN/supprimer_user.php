<?php
require_once('../../config/Database.php'); // connexion DB
include('../../VIEWS/admin_header.php');

// ✅ Vérifie si l'id est bien présent dans l'URL
if (!isset($_GET['id'])) {
    die("ID non spécifié.");
}

$id = intval($_GET['id']);

// ✅ Préparer la requête de suppression
$stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // ✅ Redirige après suppression avec un message
    header("Location: user.php?msg=Utilisateur supprimé avec succès");
    exit;
} else {
    echo "Erreur lors de la suppression : " . $conn->error;
}
?>
