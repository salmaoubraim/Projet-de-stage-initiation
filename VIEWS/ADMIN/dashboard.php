<?php
session_start();
if(!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true){
    header("Location: login.php");
    exit;
}

// Connexion DB
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "electro_ecommerce";
$conn = new mysqli($host, $user, $pass, $dbname);
if($conn->connect_error) die("Connexion échouée : " . $conn->connect_error);

// Statistiques dynamiques
$productCount = $conn->query("SELECT COUNT(*) AS total_products FROM produit")->fetch_assoc()['total_products'];
$orderCount = $conn->query("SELECT COUNT(*) AS total_orders FROM commande_speciale")->fetch_assoc()['total_orders'];
$userCount = $conn->query("SELECT COUNT(*) AS total_users FROM user")->fetch_assoc()['total_users'];

// Ventes mensuelles dynamiques
// Ventes mensuelles dynamiques
$ventesMensuelles = [];
for($m=1; $m<=12; $m++){
    $res = $conn->query("
        SELECT SUM(p.prix * c.quantite) AS total
        FROM commande_speciale c
        JOIN produit p ON LOWER(c.nom_produit) = LOWER(p.nom)
        WHERE MONTH(c.date_commande) = $m
    ")->fetch_assoc();

    $ventesMensuelles[] = $res['total'] ?? 0; // si pas de vente -> 0
}



// Commandes par jour de la semaine (Dim=0, Lun=1, … Sam=6)
$jours = [1,2,3,4,5,6,7]; // 1=Dimanche … 7=Samedi
$commandesParJour = [];
foreach($jours as $j){
    $res = $conn->query("SELECT COUNT(*) AS total FROM commande_speciale WHERE DAYOFWEEK(date_commande)=$j")->fetch_assoc();
    $commandesParJour[] = $res['total'] ?? 0;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin - ElectroShop</title>

<!-- Bootstrap + Font Awesome + Chart.js -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { margin:0; font-family:'Segoe UI', sans-serif; background:#f4f6f9; }
.sidebar {
    position: fixed; left:0; top:0; width:220px; height:100vh; background:#111; color:white;
    display:flex; flex-direction:column; padding-top:20px;
}
.sidebar h2 { text-align:center; margin-bottom:30px; }
.sidebar a {
    color:white; text-decoration:none; padding:15px 20px; display:block; margin-bottom:5px;
    border-radius:5px; transition: background 0.3s;
}
.sidebar a:hover { background:#333; }
.main { margin-left:220px; padding:30px; }
.card { border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.1); }
.stat-card { text-align:center; padding:20px; transition: transform 0.3s; cursor:pointer; }
.stat-card:hover { transform:translateY(-5px); }
.stat-card h3 { font-size:18px; color:#555; margin-bottom:10px; }
.stat-card p { font-size:28px; font-weight:bold; }

@media(max-width:768px){
    .sidebar { width:60px; }
    .main { margin-left:60px; padding:15px; }
}
</style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin</h2>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="products.php"><i class="fas fa-box"></i> Produits</a>
    <a href="order.php"><i class="fas fa-shopping-cart"></i> Commandes</a>
    <a href="user.php"><i class="fas fa-users"></i> Utilisateurs</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
</div>

<!-- Main content -->
<div class="main">
    <h2>Tableau de Bord</h2>
    <div class="row g-4 mt-3">
        <div class="col-md-4">
            <div class="card stat-card" onclick="window.location.href='products.php'">
                <h3>Produits</h3>
                <p><?php echo $productCount; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card" onclick="window.location.href='order.php'">
                <h3>Commandes</h3>
                <p><?php echo $orderCount; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card" onclick="window.location.href='user.php'">
                <h3>Utilisateurs</h3>
                <p><?php echo $userCount; ?></p>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Ventes Mensuelles (€)</h5>
                <canvas id="salesChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5>Commandes par jour</h5>
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Graphiques Chart.js
const ventesMensuelles = <?php echo json_encode($ventesMensuelles); ?>;
const commandesParJour = <?php echo json_encode($commandesParJour); ?>;

// Sales Chart
const salesChart = new Chart(document.getElementById('salesChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: ['Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sep','Oct','Nov','Déc'],
        datasets:[{
            label:'Ventes (€)',
            data: ventesMensuelles,
            borderColor:'#007bff',
            backgroundColor:'rgba(0,123,255,0.2)',
            tension:0.4
        }]
    },
    options:{ responsive:true, plugins:{ legend:{labels:{color:'#555'}} }, scales:{ x:{ticks:{color:'#555'}}, y:{ticks:{color:'#555'}} } }
});

// Orders Chart
const ordersChart = new Chart(document.getElementById('ordersChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels:['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        datasets:[{
            label:'Commandes',
            data: commandesParJour,
            backgroundColor:'#28a745'
        }]
    },
    options:{ responsive:true, plugins:{ legend:{display:false} }, scales:{ x:{ticks:{color:'#555'}}, y:{ticks:{color:'#555'}} } }
});
</script>

</body>
</html>
