<?php
include "connection.php";
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
    <title>theory // albums</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">albums</h1>
<p>
    <a href="welcome.php" class="btn btn-warning">home</a>
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <img src="https://images-na.ssl-images-amazon.com/images/I/71BKhn%2BOYRL._SL1425_.jpg">
                fun. // some nights
            </div>
            <div class="col-lg">
                <img src="https://images-na.ssl-images-amazon.com/images/I/61Oz6VUs1fL.jpg">
                green day // greatest hits: god's favorite band
            </div>
            <div class="col-lg">
                <img src="https://static.qobuz.com/images/covers/02/05/0073145240502_600.jpg">
                the cranberries // no need to argue
            </div>
        </div>
    </div>
</p>
</body>
</html>
