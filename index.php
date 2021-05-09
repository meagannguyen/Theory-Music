<?php

include "connection.php";

$first_name= $last_name = $email = $phone_number = $username = $password = $confirm_password = $payment = $birthday = $billing_address = "";
$first_name_err = $last_name_err = $email_err = $phone_number_err = $username_err = $password_err = $confirm_password_err = $payment_err = $birthday_err = $billing_address_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "please enter a username :)";
    } else {
        // Prepared statement
        $sql = "SELECT 'ID' FROM account WHERE 'username' = :username";

        if (isset($conn)) {
            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

                // Set parameters
                $param_username = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        $username_err = "this username is already taken :(";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "oops! something went wrong...please try again later";
                }

                // Close statement
                unset($stmt);
            }
        }
    }

    // Validate first name
    /* $sql = "SELECT 'ID' FROM account WHERE 'first_name' = :first_name";
    if (isset($conn)) {
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
            $param_first_name = trim($_POST["first_name"]);
            if ($stmt->execute()) {
                if (empty(trim($_POST["first_name"]))) {
                    $first_name_err = "please enter your first name :)";
                } else {
                    $first_name = trim($_POST["first_name"]);
                }
            }
            else {
                echo "oops! something went wrong...please try again later";
            }
            unset($stmt);
        }
    } */
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "please enter your first name :)";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // Validate last name
    /*$sql = "SELECT 'ID' FROM account WHERE 'last_name' = :last_name";
    if (isset($conn)) {
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
            $param_last_name = trim($_POST["last_name"]);
            if ($stmt->execute()) {
                if (empty(trim($_POST["last_name"]))) {
                    $last_name_err = "please enter your last name :)";
                } else {
                    $last_name = trim($_POST["last_name"]);
                }
            }
            else {
                echo "oops! something went wrong...please try again later";
            }
            unset($stmt);
        }
    }*/
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "please enter your last name :)";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    // Validate email
    $sql = "SELECT 'ID' FROM account WHERE 'email' = :email";
    if (empty(trim($_POST["email"]))) {
        $email_err = "please enter an email address :)";
    } elseif (!str_contains(trim($_POST["email"]), '@')) {
        $email_err = "please enter a valid email address";
    } elseif (!str_contains(trim($_POST["email"]), '.')) {
        $email_err = "please enter a valid email address";
    }
    else {
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "this email is already being used :(";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "oops! something went wrong...please try again later";
            }
        }

        // Validate phone number
        $sql = "SELECT 'ID' FROM account WHERE 'phone_number' = :phone_number";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bindParam(":phone_number", $param_phone_number, PDO::PARAM_STR);
            $param_phone_number = trim($_POST["phone_number"]);
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $phone_number_err = "this phone number is already being used :(";
                } else {
                    $phone_number = trim($_POST["phone_number"]);
                }
            } else {
                echo "oops! something went wrong...please try again later";
            }
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "please enter a password :)";
        } elseif (strlen(trim($_POST["password"])) < 4) {
            $password_err = "password must have at least 4 characters";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "please confirm password";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "oh no! passwords do not match";
            }
        }

        // Validate birthday
        if (empty(trim($_POST["birthday"]))) {
            $birthday_err = "please enter your birthday :)";
        } else {
            $birthday = trim($_POST["birthday"]);
        }

        // Validate payment
        if (empty(trim($_POST["payment"]))) {
            $payment_err = "please enter your payment option :)";
        } else {
            $payment = trim($_POST["payment"]);
        }

        // Validate billing address
        if (empty(trim($_POST["billing_address"]))) {
            $billing_address_err = "please enter your billing address :)";
        } else {
            $billing_address = trim($_POST["billing_address"]);
        }

        // Check input errors before inserting in database
        if (empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($phone_number_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($birthday_err) && empty($payment_err) && empty($billing_address_err)) {
            // Prepare an insert statement
            $sql = "INSERT INTO account (first_name, last_name, email, phone_number, username, user_password, birthday, payment, billing_address) VALUES (:first_name, :last_name, :email, :phone_number, :username, :password, :birthday, :payment, :billing_address)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":first_name", $param_first_name, PDO::PARAM_STR);
                $stmt->bindParam(":last_name", $param_last_name, PDO::PARAM_STR);
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $stmt->bindParam(":phone_number", $param_phone_number, PDO::PARAM_INT);
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                $stmt->bindParam(":birthday", $param_birthday, PDO::PARAM_DATE);
                $stmt->bindParam(":payment", $param_payment, PDO::PARAM_STR);
                $stmt->bindParam(":billing_address", $param_billing_address, PDO::PARAM_STR);

                // Set parameters
                $param_first_name = $first_name;
                $param_last_name = $last_name;
                $param_email = $email;
                $param_phone_number = $phone_number;
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_birthday = $birthday;
                $param_billing_address = $billing_address;

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to login page
                    header("location: login.php");
                } else {
                    echo "oops! something went wrong...please try again later";
                }
                unset($stmt);
            }
        }
        // Close connection
        unset($conn);
    }
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
            <label>first name</label>
            <input type="text" name="first_name" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_name; ?>">
            <span class="invalid-feedback"><?php echo $first_name; ?></span>
        </div>
        <div class="form-group">
            <label>last name</label>
            <input type="text" name="last_name" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_name; ?>">
            <span class="invalid-feedback"><?php echo $last_name; ?></span>
        </div>
        <div class="form-group">
            <label>email address</label>
            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
            <span class="invalid-feedback"><?php echo $email; ?></span>
        </div>
        <div class="form-group">
            <label>phone number</label>
            <input type="tel" name="phone_number" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>">
            <span class="invalid-feedback"><?php echo $phone_number; ?></span>
        </div>
        <div class="form-group">
            <label>birthday</label>
            <input type="date" name="birthday" class="form-control <?php echo (!empty($birthday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $birthday; ?>">
            <span class="invalid-feedback"><?php echo $birthday; ?></span>
        </div>
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
            <label>payment</label>
            <input type="text" name="payment" class="form-control <?php echo (!empty($payment_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $payment; ?>">
            <span class="invalid-feedback"><?php echo $payment; ?></span>
        </div>
        <div class="form-group">
            <label>billing address</label>
            <input type="text" name="billing_address" class="form-control <?php echo (!empty($billing_address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $billing_address; ?>">
            <span class="invalid-feedback"><?php echo $billing_address; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-light" value="submit">
            <input type="reset" class="btn btn-light" value="reset">
        </div>
        <p>already have an account? <a href="login.php">login here</a>!</p>
    </form>
</div>
</body>
</html>