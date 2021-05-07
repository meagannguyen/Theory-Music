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
    <title>theory // songs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">songs</h1>
<p>
    <a href="welcome.php" class="btn btn-light btn-lg btn-block">home</a>
<div class="container">
    <div class="row">
        <div class="col">
            <img src="images/some%20nights.jpg">
            <br>
            <h2>we are young</h2>
            04:10
            <br>
            <a href="artists.php">fun.</a>
            // <a href="albums.php"> some nights</a>
            <br>
            <img src="images/play%20button.jpg">
        </div>
        <div class="col">
            <img src="images/gods%20favorite%20band.jpg">
            <br>
            <h2>boulevard of broken dreams</h2>
            04:21
            <br>
            <a href="artists.php">green day</a>
            // <a href="albums.php"> green day: god's favorite band </a>
            <br>
            <img src="images/play%20button.jpg">
        </div>
        <div class="col">
            <img src="images/no%20need%20to%20argue%20album.jpg">
            <br>
            <h2>zombie</h2>
            05:06
            <br>
            <a href="artists.php">the cranberries</a>
            // <a href="albums.php"> no need to argue</a>
            <br>
            <img src="images/play%20button.jpg">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="images/coarsegold.jpg">
            <br>
            <h2>all the faces</h2>
            02:59
            <br>
            <a href="artists.php">creed bratton</a>
            // <a href="albums.php"> coarsegold</a>
            <br>
            <img src="images/play%20button.jpg">
        </div>
        <div class="col">
            <img src="images/a%20rush%20of%20blood%20to%20the%20head.jpg">
            <br>
            <h2>clocks</h2>
            05:07
            <br>
            <a href="artists.php">coldplay</a>
            // <a href="albums.php"> a rush of blood to the head</a>
            <br>
            <img src="images/play%20button.jpg">
        </div>
        <div class="col">
            <img src="images/bee%20gees%20greatest.jpg">
            <br>
            <h2>stayin' alive</h2>
            04:45
            <br>
            <a href="artists.php">bee gees</a>
            // <a href="albums.php"> bee gees' greatest hits</a>
            <br>
            <img src="images/play%20button.jpg">
        </div>
    </div>
</div>
</p>
</body>
</html>