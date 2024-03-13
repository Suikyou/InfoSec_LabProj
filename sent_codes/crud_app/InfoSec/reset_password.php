<?php
session_start();
include("CRUD/dbcon.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the database connection is established
    if ($connection) {
        // Escape the email input
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        // Check if the email exists in the database
        $result = mysqli_query($connection, "SELECT * FROM users WHERE user_eadd='$email'");
        
        if ($result) {
            if(mysqli_num_rows($result) == 1) {
                // Email exists in the database
                $_SESSION['reset_email'] = $email; // Store the email in the session
                $row = mysqli_fetch_assoc($result);
                $security_question = $row['security_question'];
                $correct_security_answer = $row['security_answer'];
                
                // Prompt the user with the security question
                echo "<script>
                        var email = '$email'; // Store the email in a JavaScript variable
                        var securityAnswer = prompt('Please answer the following security question: $security_question');
                        if (securityAnswer !== null) {
                            // Check if the provided security answer matches the correct one
                            if (securityAnswer === '$correct_security_answer') {
                                // Redirect to reset confirm page with email
                                window.location.href = 'reset_password_confirm.php?email=' + encodeURIComponent(email);
                            } else {
                                alert('Incorrect security answer. Please try again.');
                                window.location.href = 'reset_password.php';
                            }
                        } else {
                            // User cancelled or dismissed the prompt box, redirect back to password reset page
                            window.location.href = 'reset_password.php';
                        }
                      </script>";
                exit();
            } else {
                // Email does not exist
                echo "<script>alert('Email does not exist. Please try again.');</script>";
            }
        } else {
            // Error in database query
            echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        // Handle the case where the database connection is not established
        echo "Database connection error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
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

<nav>
    <div class="branding">
    <p style="font-size: 40px;">Task Manager</p>
    </div>
    <ul>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>

<div class="container">
    <div class="box form-box">
        <header>Password Reset</header>
        <form method="POST" action="">
            <div class="field input">
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email" autocomplete="off" placeholder="Enter your email" required>
            </div>
            <div class="field">
                <button type="submit" name="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
