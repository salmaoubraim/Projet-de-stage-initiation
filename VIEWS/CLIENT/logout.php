<?php
session_start();
session_unset();
session_destroy();

// Redirection vers la page de login ou home
header("Location: login.php"); // <-- ici changer logout.php par login.php
exit;
?>
