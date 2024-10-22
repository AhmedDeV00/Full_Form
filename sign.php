<?php
include "config.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];

    $sql = "SELECT * FROM `registration` WHERE email ='$email' && password = '$password' ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error[]= "User Already exist!";
    }else {
        if ($password != $cpassword) {
            $error[]= "Password not matched!";
        }else {
            $sql2 = "INSERT INTO `registration`(`id`, `name`, `email`, `password`, `user_type`) VALUES (NULL,'$name','$email','$password','$user_type')";
            $sql3 = mysqli_query($conn, $sql2);
            if ($sql3) {
                header("Location: login.php");
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./sign.css">
    <title>Register Page</title>
</head>
<body>
    <div class="form-container">
        <form  method="post">
            <h3>register now</h3>
            <?php
            if (isset($error)) {
                foreach($error as $error); {
                    echo "<span class='error-msg'>'.$error.'</span> ";
                }
            }
            ?>
            <input type="text" name="name" required placeholder="Enter Your name">
            <input type="email" name="email" required placeholder="Enter Your email">
            <input type="password" name="password" required placeholder="Enter Your password">
            <input type="password" name="cpassword" required placeholder="Confirm Your password">
            <select name="user_type" style="width: 100%;">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="login.php">login</a></p>
        </form>
    </div>
    
</body>
</html>