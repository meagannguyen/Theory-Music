<?php
include "connection.php";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>name</th><th>country</th><th>followers</th><th>record label</th>";

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
    $stmt = $conn->prepare("SELECT name, country, num_followers, recordLabel.name FROM artist JOIN recordLabel ON artist.record_label = recordLabel.ID");
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

<!--<!DOCTYPE html>
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
    <a href="welcome.php" class="btn btn-light btn-lg btn-block">home</a>
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
</html>-->