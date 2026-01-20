<?php
class Database {
    public static function connect() {
        $conn = new mysqli("localhost", "root", "", "WT");
        if ($conn->connect_error) {
            die("DB Connection Failed");
        }
        return $conn;
    }
}
