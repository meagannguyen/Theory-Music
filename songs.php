<?php
include "connection.php";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>name</th><th>duration</th><th>artist</th><th>album</th><th>genre</th>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$servername = 'localhost';
$username = "nguyenm26";
$password = "V00873715";
$database = "project_nguyenm26";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$stmt = $conn->prepare("SELECT song.name, song.duration, artist.name, album.name, genre.name FROM song JOIN artist ON song.artist = artist.ID JOIN album ON song.album = album.ID JOIN genre ON song.genre = genre.ID");
    $stmt = $conn->prepare("SELECT song.name, song.duration, artist.name FROM song JOIN artist ON song.artist = artist.ID");
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
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
<a href="welcome.php" class="btn btn-light btn-lg">home</a>
</body>
</html>

<!-- <!DOCTYPE html>
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
            <h2>we are young <img src="images/play.jpg"></h2>
            04:10
            <br>
            <a href="artists.php">fun.</a>
            // <a href="albums.php"> some nights</a>
        </div>
        <div class="col">
            <img src="images/gods%20favorite%20band.jpg">
            <br>
            <h2>boulevard of broken dreams <img src="images/play.jpg"></h2>
            04:21
            <br>
            <a href="artists.php">green day</a>
            // <a href="albums.php"> green day: god's favorite band </a>
        </div>
        <div class="col">
            <img src="images/no%20need%20to%20argue%20album.jpg">
            <br>
            <h2>zombie <img src="images/play.jpg"></h2>
            05:06
            <br>
            <a href="artists.php">the cranberries</a>
            // <a href="albums.php"> no need to argue</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="images/coarsegold.jpg">
            <br>
            <h2>all the faces <img src="images/play.jpg"></h2>
            02:59
            <br>
            <a href="artists.php">creed bratton</a>
            // <a href="albums.php"> coarsegold</a>
        </div>
        <div class="col">
            <img src="images/a%20rush%20of%20blood%20to%20the%20head.jpg">
            <br>
            <h2>clocks <img src="images/play.jpg"></h2>
            05:07
            <br>
            <a href="artists.php">coldplay</a>
            // <a href="albums.php"> a rush of blood to the head</a>
        </div>
        <div class="col">
            <img src="images/bee%20gees%20greatest.jpg">
            <br>
            <h2>stayin' alive <img src="images/play.jpg"></h2>
            04:45
            <br>
            <a href="artists.php">bee gees</a>
            // <a href="albums.php"> bee gees' greatest hits</a>
        </div>
    </div>
</div>
</p>
</body>
</html>