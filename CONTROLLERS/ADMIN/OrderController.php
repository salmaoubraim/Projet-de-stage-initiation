<?php
require_once ('../../MODELS/OrderModel.php');
require_once ('../../config/database.php');

class OrderController {
    public function index() {
        $model = new OrderModel($GLOBALS['conn']);
        $orders = $model->getAllOrders();
        include ('../../VIEWS/ADMIN/order.php');
    }
}
