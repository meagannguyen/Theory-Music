<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>theory // artists</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">artists</h1>
<p>
    <a href="welcome.php" class="btn btn-warning">home</a>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>fun.</h2>
                <img src="images/Fun.jpg">
                United States
                7,687,700 followers
                Fueled by Ramen
                Albums:
                <a href="albums.php">some nights</a>
                Events:
                <a href="events.php">Fun. Tour</a>
            </div>
        </div>
    </div>
</p>
</body>
</html>