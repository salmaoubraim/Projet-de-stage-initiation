<?php
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();

    $method = isset($url[1]) ? $url[1] : 'index';
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        echo "Méthode '$method' introuvable.";
    }
} else {
    echo "Contrôleur '$controllerName' introuvable.";
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'login') {
        require_once 'controllers/AuthControllers/LoginControllers.php';
        $controller = new AuthController();
        $controller->login();
    } elseif ($action === 'register') {
        require_once 'controllers/AuthControllers';
        $controller = new AuthController();
        $controller->register();
    } else {
        echo "Action non reconnue.";
    }

    exit(); // Pour éviter d'afficher autre chose
}

require_once 'config/database.php';
require_once 'controllers/ProduitController.php';

$controller = new ProduitController($db);

$action = $_GET['action'] ?? 'produits';

switch($action) {
    case 'produits':
        $controller->afficherProduits();
        break;
    case 'voir_tous_produits':
        $controller->afficherProduits(null);
        break;
    case 'detail_produit':
        $controller->afficherDetailsProduit($_GET['id']);
        break;
    // ... routes supplémentaires ici
}


?>
