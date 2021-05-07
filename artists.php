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
                fun.
                <br>
                <img src="images/fun.jpg">
                <br>
                United States
                <br>
                7,687,700 followers
                <br>
                Fueled by Ramen
                <br>
                Albums:
                <a href="albums.php">some nights</a>
                <br>
                Events:
                <a href="events.php">Fun. Tour</a>
            </div>
            <div class="col">
                coldplay
                <br>
                <img src="images/coldplay.jpg">
                <br>
                United Kingdom
                <br>
                37,013,125 followers
                <br>
                Parlophone
                <br>
                Albums:
                <a href="albums.php">a rush of blood to the head</a>
            </div>
            <div class="col">
                green day
                <br>
                <img src="images/green%20day.jpg">
                <br>
                United States
                <br>
                18,807,100 followers
                <br>
                Reprise Records
                <br>
                Albums:
                <a href="albums.php">green day: god's favorite band</a>
                <br>
                Events:
                <a href="events.php">American Idiot World Tour</a>
            </div>
        </div>
    </div>
</p>
</body>
</html>