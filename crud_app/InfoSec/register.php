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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <title>Register</title>
    <style>
        /* Add your CSS styles here */
        .field {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
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
                    <div style="position:relative;">
                        <input type="password" name="password" id="password" autocomplete="off" placeholder="Enter your password here" required>
                        <i class="far fa-eye toggle-password" onclick="togglePassword('password')" id="togglePassword"></i> <!-- Eye icon -->
                    </div>
                </div>
                <div class="field input">
                    <label for="confirmPassword">Confirm Password</label>
                    <div style="position:relative;">
                        <input type="password" name="confirmPassword" id="confirmPassword" autocomplete="off" placeholder="Confirm your password" required>
                        <i class="far fa-eye toggle-password" onclick="togglePassword('confirmPassword')" id="toggleConfirmPassword"></i> <!-- Eye icon -->
                    </div>
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
    <script>
        function togglePassword(inputId) {
            var x = document.getElementById(inputId);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
<?php } ?>
