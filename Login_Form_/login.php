
<?php

session_start();
require_once "config.php";


if (isset($_SESSION["username"], $_SESSION["role"])) {
    header("Location: home.php");

}

if(isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
        if ($username === "" || $password === "") {
             echo "<script> alert('Please fill in all fields.') </script>";
        } else {
            $stmt = $conn->prepare(
                "SELECT id, name, pass, role
                 FROM users
                 WHERE name = ?
                 LIMIT 1"
            );
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($password == $user["pass"]) {
                ;
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["name"];
                $_SESSION["role"] = $user["role"];

                header("Location: home.php");
                exit;
            } else {
                echo "<script> alert('Invalid username or password.') </script>";
            }

            $stmt->close();
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
        <h3> Log-In</h3>
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
        <button type="submit" class="btn-solid theme-primary" name="submit">Log-In</button>
        
        <br><br>
        <p>Don't Have a Account?<a href="index.php"> Register! </a></p>        </form>
        
        </div>
</center>
    </body>
</html>