<?php

/* include "connection.php"; */

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Validate username
if(empty(trim($_POST["username"]))){
$username_err = "please enter a username :)";
} else{
// Prepare a select statement
$sql = "SELECT ID FROM account WHERE username = :username";

if (isset($conn)) {
if($stmt = $conn->prepare($sql)){
// Bind variables to the prepared statement as parameters
$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

// Set parameters
$param_username = trim($_POST["username"]);

// Attempt to execute the prepared statement
if($stmt->execute()){
if($stmt->rowCount() == 1){
$username_err = "this username is already taken :(";
} else{
$username = trim($_POST["username"]);
}
} else{
echo "oops! something went wrong...please try again later";
}

// Close statement
unset($stmt);
}
}
}

// Validate password
if(empty(trim($_POST["password"]))){
$password_err = "please enter a password :)";
} elseif(strlen(trim($_POST["password"])) < 6){
$password_err = "password must have at least 6 characters";
} else{
$password = trim($_POST["password"]);
}

// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
$confirm_password_err = "please confirm password";
} else{
$confirm_password = trim($_POST["confirm_password"]);
if(empty($password_err) && ($password != $confirm_password)){
$confirm_password_err = "oh no! passwords do not match";
}
}

// Check input errors before inserting in database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

// Prepare an insert statement
$sql = "INSERT INTO account (username, password) VALUES (:username, :password)";

if($stmt = $conn->prepare($sql)){
// Bind variables to the prepared statement as parameters
$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
$stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

// Set parameters
$param_username = $username;
$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

// Attempt to execute the prepared statement
if($stmt->execute()){
// Redirect to login page
header("location: login.php");
} else{
echo "oops! something went wrong...please try again later";
}

// Close statement
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
    <title>theory // signup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 20px 'Courier New'; }
        .wrapper{ width: 500px; padding: 20px; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>create an account</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>username</label>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <label>password</label>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <label>confirm password</label>
            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="submit">
            <input type="reset" class="btn btn-secondary ml-2" value="reset">
        </div>
        <p>already have an account? <a href="login.php">login here</a>!</p>
    </form>
</div>
</body>
</html>