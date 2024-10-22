<?php

include 'config.php';

session_start();

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $pass = md5($_POST['password']);

   // Query to select user
   $sql = "SELECT * FROM `registration` WHERE email = '$email' && password = '$pass'";

   // Execute the query
   $result = mysqli_query($conn, $sql);

   // Check if any rows were returned
   if (mysqli_num_rows($result) > 0) {
      // Fetch the data
      $row = mysqli_fetch_array($result);

      // Ensure $row is not null
      if ($row && isset($row['user_type'])) {
         if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');
         } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:user.php');
         }
      } else {
         $error[] = 'User type not found!';
      }

   } else {
      $error[] = 'Incorrect email or password!';
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
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                foreach($error as $error); {
                    echo "<span class='error-msg'>'.$error.'</span> ";
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Enter Your email">
            <input type="password" name="password" required placeholder="Enter Your password">
            <input type="submit" name="submit" value="login now" class="form-btn">
            <p>don't have an account? <a href="sign.php">register</a></p>
        </form>
    </div>
    
</body>
</html>