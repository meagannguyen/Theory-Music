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

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $currentUser = $_SESSION["username"];
    $sql = $conn->prepare("SELECT ID FROM account WHERE username = :currentUser");
    $sql->bindParam(':currentUser', $currentUser, PDO::PARAM_STR);
    $sql->execute();
    $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = :sql");
    $stmt->bindParam(':sql', $sql, PDO::PARAM_STR);
    $stmt->execute();
//    $sql = "SELECT ID FROM account WHERE username = :currentUser";
//    $stmt = $conn->prepare($sql);
//
    console_log( $sql );
//    console_log( $stmt );

    /*$currentUser = $_SESSION["username"];
    $sql = $conn->prepare("SELECT ID FROM account WHERE username = :currentUser");
    $sql->bindParam(':currentUser', $currentUser, PDO::PARAM_STR);
    $sql->execute();
    if ($currentUser = 'michaelscott') {
        $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = 1");
    }
    elseif ($currentUser = 'ultimatesithlord') {
        $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = 2");
    }
    elseif ($currentUser = 'jimhalpert') {
        $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = 3");
    }
    elseif ($currentUser = 'artist4life') {
        $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = : 4");
    }
    elseif ($currentUser = 'narddog') {
        $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = 5");
    }
    else {
        $stmt = $conn->prepare("SELECT playlist.name AS playlist, playlist.date_created AS 'date created', playlist.duration AS duration, playlist.num_followers AS followers FROM playlist WHERE playlist.account = :currentUser");
    }
    $stmt->execute(); */
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
</body>
</html>