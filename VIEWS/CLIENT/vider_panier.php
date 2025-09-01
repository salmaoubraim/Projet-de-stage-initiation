<?php
session_start();
$_SESSION['panier'] = [];
echo json_encode(['status'=>'success']);
