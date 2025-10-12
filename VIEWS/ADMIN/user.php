<?php
require_once('../../config/Database.php');
include('../../VIEWS/admin_header.php');

// Récupération des utilisateurs
$sql = "SELECT * FROM user ORDER BY created_at DESC";
$result = $conn->query($sql);

$user = [];
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007BFF;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        header nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }
       
        .container {
            width: 90%;
            margin: 40px auto;
            text-align: right;
        }
        .add-btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .add-btn:hover {
            background: #114480ff;
            color: white;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            border: 1px solid black;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e2e2e2;
        }
        a.action-btn {
            color: #007BFF;
            text-decoration: none;
            margin: 0 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="ajouter_user.php" class="add-btn">Ajouter un utilisateur</a>
</div>

<table>
  <tr>
    <th>ID</th>
    <th>Nom utilisateur</th>
    <th>Email</th>
    <th>Date inscription</th>
    <th>Action</th>
  </tr>
  <?php if (!empty($user)) : ?>
      <?php foreach ($user as $u): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= $u['nom_utilisateur'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['created_at'] ?></td>
            <td>
                <a href="modifier_user.php?id=<?= $u['id'] ?>" class="action-btn">Modifier</a> |
                <a href="supprimer_user.php?id=<?= $u['id'] ?>" class="action-btn" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">Supprimer</a>
            </td>
          </tr>
      <?php endforeach; ?>
  <?php else: ?>
      <tr><td colspan="5">Aucun utilisateur trouvé</td></tr>
  <?php endif; ?>
</table>

</body>
</html>
