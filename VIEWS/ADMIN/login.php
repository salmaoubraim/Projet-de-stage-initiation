<?php
session_start();
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: dashboard.php");
    exit;
}
include '../../VIEWS/admin_header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  label {
    display: block;
    text-align: left;  /* <-- ici */
    margin-bottom: 8px;
    font-weight: 600;
  }

    </style>
<body style="background: linear-gradient(135deg, #000000, #484545ff, #000000);">

<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 80px);">
  <div class="card shadow-lg p-4 rounded-4" style="width: 100%; max-width: 400px; background: black; backdrop-filter: blur(12px);">
    <div class="card-body text-center">
      <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
      <?php endif; ?>
<form method="POST" action="../../controllers/ADMIN/login_process.php">
  <h1 style="color:white">Login</h1>
  <label style="color:white"> Email:</label>
        <div class="mb-3">
          <input type="email" class="form-control form-control-lg rounded-pill bg-dark text-light border-light" placeholder="Adresse Email" name="email" required>
        </div>
        <div class="mb-3">
            <label style="color:white"> Password:</label>
          <input type="password" class="form-control form-control-lg rounded-pill bg-dark text-light border-light" placeholder="Mot de passe" name="password" required>
        </div>
        <button type="submit" style="background: #afadadff;" class="btn btn-primary w-100 btn-lg rounded-pill fw-bold">Se connecter</button>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
