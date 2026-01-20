<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
$action = $_GET['action'] ?? '';

if (in_array($action, ['getProducts', 'sellerSales'])) {
    header("Content-Type: text/html; charset=UTF-8");
} else {
    header("Content-Type: application/json; charset=UTF-8");
}
require_once dirname(__DIR__) . "/config/database.php";
require_once dirname(__DIR__) . "/models/User.php";
require_once dirname(__DIR__) . "/models/Product.php";
require_once dirname(__DIR__) . "/models/Order.php";

$action = $_GET['action'] ?? '';

/* ---------- LOGIN ---------- */
if ($action === "login") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($email === "" || $password === "") {
        echo json_encode(["status"=>"error","msg"=>"All fields required"]);
        exit;
    }

    $user = User::login($email);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['seller_id'] = $user['id'];
        $_SESSION['seller_name'] = $user['name'];

        setcookie("login", $user['id'], time()+3600, "/");

        echo json_encode(["status"=>"success"]);
    } else {
        echo json_encode(["status"=>"error","msg"=>"Invalid login"]);
    }
}

/* ---------- REGISTER ---------- */
if ($action === "register") 
{

    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];
    $cpass = $_POST['cpassword'];

    if ($name=="" || $email=="" || $pass=="" || $cpass=="") {
        echo json_encode(["status"=>"error","msg"=>"All fields required"]);
        exit;
    }

    if ($pass !== $cpass) {
        echo json_encode(["status"=>"error","msg"=>"Password not match"]);
        exit;
    }

    if (User::register($name, $email, $pass)) {
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode([
        "status"=>"error",
        "msg"=>"DB insert failed"
    ]);
}


/* ---------- ADD PRODUCT ---------- */
if ($action == "addProduct") {

    if(!isset($_SESSION['seller_id'])){
        echo json_encode(["status"=>"error","msg"=>"Unauthorized"]);
        exit;
    }

    $title = trim($_POST['title']);
    $price = $_POST['price'];

    // PHP validation
    if ($title=="" || $price=="") {
        echo json_encode(["status"=>"error","msg"=>"All fields required"]);
        exit;
    }

    if (!isset($_FILES['image'])) {
        echo json_encode(["status"=>"error","msg"=>"Image required"]);
        exit;
    }

    $img = $_FILES['image'];
    $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
    $newName = time().rand(1000,9999).".".$ext;

    move_uploaded_file($img['tmp_name'], "../public/uploads/".$newName);

    Product::add($_SESSION['seller_id'], $title, $price, $newName);

    echo json_encode(["status"=>"success","msg"=>"Product added"]);
}
/* ---------- GET PRODUCTS ---------- */
if ($action == "getProducts") {

    if(!isset($_SESSION['seller_id'])) exit;

    $products = Product::getBySeller($_SESSION['seller_id']);

    while($p = $products->fetch_assoc()){
        echo "
        <div style='display:inline-block;margin:10px;padding:10px;border:1px solid #ccc'>
            <img src='/WT/public/uploads/{$p['image']}' width='150'><br>
            <b>{$p['title']}</b><br>
            Price: {$p['price']}
        </div>
        ";
    }
}
/* ---------- SELLER SALES HISTORY ---------- */
if($action == "sellerSales"){

    if(!isset($_SESSION['seller_id'])) exit;

    $orders = Order::getSellerOrders($_SESSION['seller_id']);

    echo "<h2>My Sales History</h2>";

    echo "<table border='1' cellpadding='10'>
        <tr>
            <th>Product</th>
            <th>Buyer</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Date</th>
        </tr>";

    while($o = $orders->fetch_assoc()){
        echo "
        <tr>
            <td>{$o['title']}</td>
            <td>{$o['buyer_name']}</td>
            <td>{$o['quantity']}</td>
            <td>{$o['price']}</td>
            <td>{$o['created_at']}</td>
        </tr>
        ";
    }

    echo "</table>";
}
