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
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px 'Courier New'; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>! welcome to theory :)</h1>
<p>
    <a href="reset-password.php" class="btn btn-warning">reset password</a>
    <a href="logout.php" class="btn btn-danger ml-3">sign out</a>
</p>
</body>
</html>