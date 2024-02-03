<?php
session_start();
include("CRUD/dbcon.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <div class="box form-box">
        <?php
        include("config.php");
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);

            // Debugging: Display the email and password for verification
            echo "Email: $email <br>";
            echo "Password: $password <br>";

            // Fetch user from database based on email
            $result = mysqli_query($con, "SELECT * FROM users WHERE emailAdd='$email'") or die("Select Error: " . mysqli_error($con));

            // Debugging: Display the SQL query for verification
            $query = "SELECT * FROM users WHERE emailAdd='$email'";
            echo "Query: $query <br>";

            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                // Debugging: Display the hashed password from the database
                $hashed_password_from_db = $row['password'];
                echo "Hashed Password from DB: $hashed_password_from_db <br>";

                // Verify password
                if(password_verify($password, $hashed_password_from_db)) {
                    // Password is correct
                    $_SESSION['valid'] = $row['emailAdd'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['id'] = $row['id'];

                    // Redirect to tasks page
                    echo "<script>alert('Account logged in! Redirecting to the tasks page.'); window.location='CRUD/index.php';</script>";
                    exit(); // Stop execution
                } else {
                    // Password is incorrect
                    echo "<div class='message'>
                            <p>Wrong Username or Password. Please try again!</p>
                        </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
                }
            } else {
                // User not found
                echo "<div class='message'>
                        <p>User not found. Please try again!</p>
                    </div> <br>";
                echo "<a href='login.php'><button class='btn'>Go Back</button></a>";
            }
        } else {
            echo "Submit not set.<br>";
        }
        ?>
        <header>Login</header>
        <form action="login.php" method="post">
            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" placeholder="Enter email here" required>
            </div>
            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter password here" required>
            </div>
            <div class="field">
                <input type="submit" name="submit" class="btn">
            </div>
            <div class="links">
                Don't have an account yet? <a href="register.php">Sign Up Now</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
