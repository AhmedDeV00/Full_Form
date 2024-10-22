<?php
session_start();
include "config.php";
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <title>User Page</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h3>Hi, <span>user</span></h3>
            <h1>Welcome <span><?php echo  $_SESSION['user_name'] ?></span></h1>
            <p>this is an user page</p>
            <a href="login.php" class="btn">Login</a>
            <a href="sign.php" class="btn">Register</a>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
    
</body>
</html>