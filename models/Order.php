<?php
require_once __DIR__ . '../config/database.php';

class Order {

    public static function getSellerOrders($seller_id){
        $conn = Database::connect();
        $sql = "
        SELECT 
            order_items.*, 
            products.title, 
            users.name AS buyer_name,
            orders.created_at
        FROM order_items
        JOIN products ON order_items.product_id = products.id
        JOIN orders ON order_items.order_id = orders.id
        JOIN users ON orders.buyer_id = users.id
        WHERE order_items.seller_id = ?
        ORDER BY orders.id DESC
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $seller_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
