<?php
include "connection.php";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>name</th><th>release year</th><th>duration</th><th>song quantity</th><th>artist</th>";

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
    $stmt = $conn->prepare("SELECT name, release_year, duration, song_quantity, artist FROM albums");
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



<!-- <!DOCTYPE html>
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
    <a href="welcome.php" class="btn btn-light btn-lg btn-block">home</a>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <img src="images/some%20nights.jpg">
                <a href="artists.php">fun.</a>
                // some nights
            </div>
            <div class="col-sm">
                <img src="images/gods%20favorite%20band.jpg">
                <a href="artists.php">green day</a>
                // greatest hits: god's favorite band
            </div>
            <div class="col-sm">
                <img src="images/no%20need%20to%20argue%20album.jpg">
                <a href="artists.php">the cranberries</a>
                // no need to argue
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <img src="images/coarsegold.jpg">
                <a href="artists.php">creed bratton</a>
                // coarsegold
            </div>
            <div class="col-sm">
                <img src="images/a%20rush%20of%20blood%20to%20the%20head.jpg">
                <a href="artists.php">coldplay</a>
                // a rush of blood to the head
            </div>
            <div class="col-sm">
                <img src="images/bee%20gees%20greatest.jpg">
                <a href="artists.php">bee gees</a>
                // bee gees' greatest
            </div>
        </div>
    </div>
</p>
</body>
</html> -->