<?php
require_once __DIR__ . '/../config/database.php';

class User {

    public static function login($email) {
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM seller WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public static function register($name, $email, $password) {
        $conn = Database::connect();
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO seller (name,email,password) VALUES (?,?,?)"
        );
        $stmt->bind_param("sss", $name, $email, $hash);

        return $stmt->execute();
    }
}
