<?php
session_start();
if(!isset($_SESSION['seller_id'])){
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seller Dashboard</title>
    <link rel="stylesheet" href="../public/css/dashboard.css">
</head>
<body>

<!-- Header -->
<div class="header">
    <a href="../index.php">Home</a>
    <span class="title">amarshop.com</span>
    <div>
        <a href="#" class="danger">Delete Account</a>
        <a href="#">Logout</a>
    </div>
</div>

<!-- Profile Section -->
<div class="profile-container">

    <div class="profile-img">
        <img src="../public/images/default.png">
    </div>

    <div class="profile-info">
        <p><b>Name:</b> <span id="name">Loading...</span></p>
        <p><b>Phone:</b> <span id="phone">Loading...</span></p>
        <p><b>Address:</b> <span id="address">Loading...</span></p>

        <h3>Edit Profile</h3>

        <form id="profileForm" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name"><br>
            <input type="text" name="phone" placeholder="Phone"><br>
            <textarea name="address" placeholder="Address"></textarea><br>
            <input type="file" name="photo"><br><br>
            <button type="submit">Update Profile</button>
        </form>
    </div>

</div>
<hr>

<h2>Add Product</h2>
<hr>
<button onclick="loadSales()">View My Sales History</button>
<div id="salesHistory"></div>


<form id="productForm" enctype="multipart/form-data">
    <input type="text" name="title" id="ptitle" placeholder="Product Title"><br><br>
    <input type="number" name="price" id="pprice" placeholder="Price"><br><br>
    <input type="file" name="image"><br><br>
    <button type="submit">Add Product</button>
</form>
<h2>My Products</h2>
<div id="productList"></div>

<div id="productMsg"></div>

<script src="../WT/public/js/validation.js"></script>
</body>
</html>
