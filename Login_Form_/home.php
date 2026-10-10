<?php
session_start();

if (!isset($_SESSION["user_id"], $_SESSION["role"])) {
    header("Location: index.php");
    exit;
}


$username = $_SESSION["username"];

?>


<!DOCTYPE HTML>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B/GM4XqrwHnWXNOWMbloTmrYXZg10cakYGmpfsR/bbzQ6JAJI4ihuyADKLnBgrCe" crossorigin="anonymous">
        <script type="module" src="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-1a/pXj49ZQ1aHEmrJ+gMw1otqoVsYwlEnlD8mIfY2TV03r20Y0CN7uqx1tQogjPL" crossorigin="anonymous"></script>
    </head>
    <body style="background-color:#FAF9F6;">
        <center>
        <div style="background-color:white;width:500px; margin-top:300px; padding-top:80px;height:200px;box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);">
            <h3> <?php echo "Welcome ".$_SESSION['username'];?></h3>
            <a href="logout.php"> Log-out</a>
        </div>
</center>
</body>
</html>