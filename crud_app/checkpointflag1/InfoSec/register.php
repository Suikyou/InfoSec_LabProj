<?php
session_start();
include("config.php");
include("CRUD/dbcon.php");

// Initialize variables to hold user input and error message
$user_fname = "";
$user_lname = "";
$user_eadd = "";
$errorMessage = "";

if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $user_fname = $_POST['firstName'];
    $user_lname = $_POST['lastName'];
    $user_eadd = $_POST['emailAdd'];
    $user_pw = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if first name and last name contain only letters
    if (!preg_match("/^[a-zA-Z]*$/", $user_fname) || !preg_match("/^[a-zA-Z]*$/", $user_lname)) {
        $errorMessage = "First name and last name must contain only letters.";
    } elseif (!filter_var($user_eadd, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        $errorMessage = "Invalid email format. Please enter a valid email address.";
    } elseif ($user_pw !== $confirmPassword) {
        // Check if password and confirm password match
        $errorMessage = "Password and Confirm Password do not match. Please try again.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($user_pw, PASSWORD_BCRYPT);

        // Verifying the unique email
        $verify_query = mysqli_query($con, "SELECT user_id_pk FROM users WHERE user_eadd='$user_eadd'");

        if ($verify_query === false) {
            $errorMessage = "Error: " . mysqli_error($con);
        } elseif (mysqli_num_rows($verify_query) != 0) {
            $errorMessage = "This Email Address is already taken. Try another one, please!";
        } else {
            $insert_query = mysqli_query($con, "INSERT INTO users(user_fname, user_lname, user_eadd, user_pw) VALUES ('$user_fname', '$user_lname', '$user_eadd', '$hashedPassword')");

            if ($insert_query === false) {
                $errorMessage = "Error: " . mysqli_error($con);
            } else {
                // Redirect to login page after successful registration
                echo "<script>alert('Registration Complete! Redirecting you to the login menu.'); window.location='login.php';</script>";
                exit(); // Stop execution
            }
        }
    }
}
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
        <a>Task Man</a>
    </div>
    <ul>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>
<div class="container">
    <div class="box form-box">
        <header>Sign Up</header>
        <form action="" method="post">
            <div class="field input">
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" autocomplete="off" placeholder="Enter your first name here" value="<?php echo htmlspecialchars($user_fname); ?>" pattern="[A-Za-z]+" title="Please enter letters only" required>
            </div>
            <div class="field input">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" autocomplete="off" placeholder="Enter your last name here" value="<?php echo htmlspecialchars($user_lname); ?>" pattern="[A-Za-z]+" title="Please enter letters only" required>
            </div>
            <div class="field input">
                <label for="emailAdd">Email Address</label>
                <input type="text" name="emailAdd" id="emailAdd" autocomplete="off" placeholder="Enter your email address here" value="<?php echo htmlspecialchars($user_eadd); ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
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
        <?php if (!empty($errorMessage)) : ?>
            <div class="message">
                <p><?php echo $errorMessage; ?></p>
            </div>
        <?php endif; ?>
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
