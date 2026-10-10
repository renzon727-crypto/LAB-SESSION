<?php

session_start();
require_once "config.php";


if (isset($_SESSION["username"], $_SESSION["role"])) {
    header("Location: home.php") ;

    exit;
}

if(isset($_POST['submit'])){
     $username = $_POST["username"];
    $password = $_POST["password"];
        
        

        if ($username === "" || $password === "" ) {
             echo "<script> alert('Please fill in all fields.') </script>";
        } elseif (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username)) {
            echo "<script> alert('Username must be 3-50 characters using letters, numbers, or underscores.') </script>";
        } elseif (strlen($password) < 8) {
            echo "<script> alert('Password must be at least 8 characters.') </script>";
        } else {
            $check = $conn->prepare(
                "SELECT id FROM users WHERE name = ? LIMIT 1"
            );
            $check->bind_param("s", $username);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                  echo "<script> alert('Username already exist') </script>";
            } else {
                

                // Public registration always creates a regular user.
                $stmt = $conn->prepare(
                    "INSERT INTO users (name, pass, role)
                     VALUES (?, ?, 'user')"
                );
                $stmt->bind_param("ss", $username, $password);

                if ($stmt->execute()) {
                      echo "<script> alert('Successful Registration') </script>";
                    header("Location: login.php");
                    exit;
                } else {
                      echo "<script> alert('Registration Failed, PLease Try Again') </script>";
                }

                $stmt->close();
            }

            $check->close();
        }




}


?>






<!DOCTYPE HTML>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
        <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
    </head>
    <body style="background-color:#FAF9F6;">
        
        <center>
        <div style="background-color:white;width:500px; margin-top:150px; padding-top:90px;height:500px;box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);">
        <h3 > Register</h3>
        <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" style="width :400px;">
           
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" style="width :400px;">
        </div>
        <br>
        <button type="submit" class="btn-solid theme-primary" name="submit">Register</button>
        </form>
        <br>
        <p>Already Have a Account?<a href="login.php"> Log-In </a></p>
        </div>
</center>
    </body>
</html>