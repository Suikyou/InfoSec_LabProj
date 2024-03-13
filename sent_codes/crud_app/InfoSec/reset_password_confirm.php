<?php
session_start();
// After session_start(), add debugging output
//var_dump($_SESSION['reset_email']);

// Include the database connection file
include("CRUD/dbcon.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the new password and confirm password fields are set
    if (isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if the new password and confirm password match
        if ($new_password === $confirm_password) {
            // Retrieve the user's email from the session
            if (isset($_SESSION['reset_email'])) {
                $email = $_SESSION['reset_email'];

                // Hash the new password before updating the database
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Perform the password update query
                $update_query = "UPDATE users SET user_pw = '$hashed_password' WHERE user_eadd = '$email'";

                if (mysqli_query($connection, $update_query)) {
                    // Password updated successfully
                    echo "<script>
                            alert('Password reset successful.');
                            window.location.href = 'login.php'; // Redirect to your success page
                          </script>";
                }  else {
                    // Error updating password
                    echo "<script>alert('Error resetting password: " . mysqli_error($connection) . "');</script>";
                }
            } else {
                // Email not found in session
                echo "<script>alert('Email not found.');</script>";
            }
        } else {
            // Passwords don't match
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
        }
    } else {
        // New password or confirm password fields not set
        echo "<script>alert('New password or confirm password fields are not set.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Confirmation</title>
    <!-- Add your custom styles here -->
    <link rel="stylesheet" href="style.css">
    <style>
        nav {
            background-color: white; /* Set background color to white */
            height: 60px;
            display: flex;
            justify-content: space-between; /* Change to space-between to move branding to the left */
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            text-decoration: none;
            border-bottom: 1px solid black; /* Add border under the navbar */
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end; /* Change to flex-end to align items to the right */
            align-items: center;
        }

        nav li {
            display: inline-block;
            margin: 0 10px;
            text-decoration: none;
        }

        nav a {
            color: black;
            text-decoration: none;
            padding: 10px;
            position: relative;
        }

        nav a:after {
            content: "";
            height: 3px;
            background-color: #f1c40f;
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
            transform: scaleX(0);
        }

        nav a:hover:after {
            opacity: 1;
            transform: scaleX(1);
        }

        .branding {
            margin-left: 20px; /* Adjust as needed to move the branding further left */
        }

        .branding a {
            color: black;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
            background-color: #26334e; /* Change background color */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Password Reset</header>
            <form method="POST" action="">
                <div class="field input">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" autocomplete="off" placeholder="Enter your new password" required>
                </div>
                <div class="field input">
                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" autocomplete="off" placeholder="Confirm your new password" required>
                </div>
                <div class="field">
                    <button type="submit" name="submit" class="btn">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
