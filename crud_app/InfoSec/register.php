<?php
session_start();
include("config.php");
include("CRUD/dbcon.php");
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAdd = $_POST['emailAdd'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo "<div class='message'>
                <p>Password and Confirm Password do not match. Please try again.</p>
            </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
        exit(); // Stop execution if passwords don't match
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Verifying the unique email
    $verify_query = mysqli_query($con, "SELECT id FROM users WHERE emailAdd='$emailAdd'");

    if ($verify_query === false) {
        die('Error: ' . mysqli_error($con));
    }

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
                <p>This Email Address is already taken. Try another one, please!</p>
            </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
    } else {
        $insert_query = mysqli_query($con, "INSERT INTO users(firstName, lastName, emailAdd, password) VALUES ('$firstName', '$lastName', '$emailAdd', '$hashedPassword')");

        if ($insert_query === false) {
            die('Error: ' . mysqli_error($con));
        }

        echo "<div class='message'>
        <p>Registration Complete!</p>
            </div> <br>";

        echo "<script>alert('Account registration complete! Redirecting you to the login menu.'); window.location='login.php';</script>";
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="" method="post"> 
                <div class="field input">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" id="firstName" autocomplete="off" placeholder="Enter your first name here" required>
                </div>
                <div class="field input">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" id="lastName" autocomplete="off" placeholder="Enter your last name here" required>
                </div>
                <div class="field input">
                    <label for="emailAdd">Email Address</label>
                    <input type="text" name="emailAdd" id="emailAdd" autocomplete="off" placeholder="Enter your email address here" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter your password here" required>
                    <i class="fa fa-eye" id="togglePassword"></i>
                </div>
                <div class="field input">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" autocomplete="off" placeholder="Confirm your password" required>
                    <i class="fa fa-eye" id="togglePassword"></i>
                </div>
                <div class="field">
                    <input type="submit" name="submit" class="btn" value="Sign Up" required>
                </div>
                <div class="links">
                    Already have an account? <a href="login.php">Login Now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php } ?>
