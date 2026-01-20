<!DOCTYPE html>
<html>
<head>
    <title>Seller Registration</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>
<body>

<div class="login-box">
    <h2>Seller Registration</h2>

    <form id="registerForm">
        <input type="text" name="name" id="name" placeholder="Full Name"><br>
        <input type="email" name="email" id="email" placeholder="Email"><br>
        <input type="password" name="password" id="password" placeholder="Password"><br>
        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"><br>
        <button type="submit">Register</button>
    </form>

    <p>Already have account? <a href="login.php">Login</a></p>
</div>

<script src="../public/js/validation.js"></script>
</body>
</html>