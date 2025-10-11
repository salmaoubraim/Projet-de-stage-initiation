<?php include '../../VIEWS/admin_header.php'; 
include '../../config/database.php';

// Requête pour récupérer toutes les commandes spéciales
$sql = "SELECT * FROM commande_speciale ORDER BY date_commande DESC";
$result = $conn->query($sql);

$orders = [];
if ($result && $result->num_rows > 0) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<style>
  body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
     display: flex;
     flex-direction: column;
     min-height: 100vh; /* 100% de la hauteur de l’écran */
     margin: 0;
  }
  table {
      width: 90%;
         margin-top: 100px;
 /* centre le tableau */
         margin-left: 50px;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    

  }
  th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center; /* centre le texte dans les cellules */
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
  a {
      color: #007BFF;
      text-decoration: none;
  }
  a:hover {
      text-decoration: underline;
  }
</style>

<table>
  <tr>
    <th>ID</th><th>Utilisateur</th><th>Produit</th><th>Quantité</th>
    <th>Adresse</th><th>Status</th><th>Date</th><th>Action</th>
  </tr>
  <?php if (!empty($orders)) : ?>
      <?php foreach ($orders as $order): ?>
          <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['username'] ?></td>
            <td><?= $order['nom_produit'] ?></td>
            <td><?= $order['quantite'] ?></td>
            <td><?= $order['adresse'] ?></td>
            <td><?= $order['status'] ?></td>
            <td><?= $order['date_commande'] ?></td>
            <td>
    <a href="voir_commande.php?id=<?= $order['id'] ?>" class="btn btn-info btn-sm">Voir</a> | 
    <a href="supprimer_commande.php?id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette commande ?');">Supprimer</a> | 
    <a href="modifier_commande.php?id=<?= $order['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
            </td>
          </tr>
      <?php endforeach; ?>
  <?php else: ?>
      <tr><td colspan="8">Aucune commande trouvée</td></tr>
  <?php endif; ?>
</table>
