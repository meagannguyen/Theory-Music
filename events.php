<?php
include "connection.php";
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>event name</th><th>artist</th><th>venue</th><th>city</th><th>state</th><th>country</th><th>date</th><th>time</th></tr>";

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
    $stmt = $conn->prepare("SELECT artist_event.name AS 'event name', artist.name AS artist, artist_event.venue AS venue, artist_event.city AS city, artist_event.state AS state, artist_event.country AS country, artist_event.event_date AS date, artist_event.event_time AS time
    FROM artist_event JOIN artist ON artist_event.artist = artist.ID");
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
    <title>theory // events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<a href="welcome.php" class="btn btn-light btn-lg">home</a>
</body>
</html>