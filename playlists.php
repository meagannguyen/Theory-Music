<?php
include "connection.php";
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>playlist</th><th>date created</th><th>duration</th><th>followers</th>";

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
    $currentUser = $_SESSION["username"];
    $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = (SELECT ID from account WHERE username = :currentUser)");
    $stmt->bindParam(':currentUser', $currentUser, PDO::PARAM_STR);
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
    <title>theory // playlists</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<a href="welcome.php" class="btn btn-light btn-lg">home</a>
<a href="addplaylist.php" class="btn btn-light btn-lg">add</a>
<a href="deleteplaylist.php" class="btn btn-light btn-lg">delete</a>
</body>
</html>