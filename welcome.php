<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>theory // home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h1>
<h2>select one of the following:</h2>
<p>
    <a href="albums.php" class="btn btn-outline-info">albums</a>
    <a href="artists.php" class="btn btn-outline-info">artists</a>
    <a href="genres.php" class="btn btn-outline-info">genres</a>
    <a href="playlists.php" class="btn btn-outline-info">playlists</a>
    <a href="songs.php" class="btn btn-outline-info">songs</a>
    <a href="logout.php" class="btn btn-danger ml-10">sign out</a>
</p>
</body>
</html>