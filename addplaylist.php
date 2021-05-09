<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$playlist_name = $date_created = $duration = $num_followers = "";
$playlist_name_err = $date_created_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["playlist_name"]))) {
        $playlist_name_err = "please enter a name for your playlist :)";
    } else {
        // Prepared statement
        $sql = "SELECT account FROM playlist WHERE 'name' = :playlist_name";

        if (isset($conn)) {
            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":playlist_name", $param_playlist_name, PDO::PARAM_STR);

                // Set parameters
                $param_playlist_name = trim($_POST["playlist_name"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        $playlist_name_err = "playlist name already used";
                    } else {
                        $playlist_name = trim($_POST["playlist_name"]);
                    }
                } else {
                    echo "oops! something went wrong...please try again later";
                }

                // Close statement
                unset($stmt);
            }
        }
    }

    $currentUser = $_SESSION["username"];
        // Check input errors before inserting in database
        if (empty($playlist_name_err)) {
            // Prepare an insert statement
            $sql = "INSERT INTO playlist (account, name, date_created, duration, num_followers) VALUES ((SELECT ID from account WHERE username = :currentUser), :playlist_name, CURRENT_DATE, '00:00:00', 0)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":currentUser", $currentUser, PDO::PARAM_STR);
                $stmt->bindParam(":playlist_name", $playlist_name, PDO::PARAM_STR);

                // Set parameters
                $playlist_name = $param_playlist_name;

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to login page
                    header("location: playlist.php");
                } else {
                    echo "oops! something went wrong...please try again later";
                }
                unset($stmt);
            }
        }
        // Close connection
        unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>theory // add playlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; }
        .wrapper{ width: 500px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>add playlist</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>playlist name</label>
            <input type="text" name="playlist_name" class="form-control <?php echo (!empty($playlist_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $playlist_name; ?>">
            <span class="invalid-feedback"><?php echo $playlist_name; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-light" value="submit">
            <input type="reset" class="btn btn-light" value="reset">
            <button class="btn btn-light"><a href="playlists.php">cancel</a></button>
        </div>
    </form>
</div>
</body>
</html>