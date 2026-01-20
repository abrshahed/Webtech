<?php
require_once __DIR__ . '../config/database.php';

class Product {

    public static function add($seller_id, $title, $price, $image) {
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO products (seller_id,title,price,image) VALUES (?,?,?,?)");
        $stmt->bind_param("isds", $seller_id, $title, $price, $image);
        return $stmt->execute();
    }

    public static function getBySeller($seller_id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE seller_id=? ORDER BY id DESC");
        $stmt->bind_param("i", $seller_id);
        $stmt->execute();
        return $stmt->get_result();
    }
}
