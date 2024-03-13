<?php
session_start();
include("config.php");
include("CRUD/dbcon.php");

// Initialize variables to hold user input and error message
$user_fname = "";
$user_lname = "";
$user_eadd = "";
$security_question = "";
$security_answer = "";
$errorMessage = "";

if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $user_fname = $_POST['firstName'];
    $user_lname = $_POST['lastName'];
    $user_eadd = $_POST['emailAdd'];
    $user_pw = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

    // Check if passwords match
    if ($user_pw !== $confirmPassword) {
        $errorMessage = "Password and Confirm Password do not match. Please try again.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($user_pw, PASSWORD_BCRYPT);

        // Verify unique email
        $verify_query = mysqli_query($con, "SELECT user_id_pk FROM users WHERE user_eadd='$user_eadd'");
        if ($verify_query === false) {
            $errorMessage = "Error: " . mysqli_error($con);
        } elseif (mysqli_num_rows($verify_query) != 0) {
            $errorMessage = "This Email Address is already taken. Try another one, please!";
        } else {
            // Insert user data into the users table
            $insert_query = mysqli_query($con, "INSERT INTO users(user_fname, user_lname, user_eadd, user_pw, security_question, security_answer) VALUES ('$user_fname', '$user_lname', '$user_eadd', '$hashedPassword', '$security_question', '$security_answer')");
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
    <p style="font-size: 40px;">Task Manager</p>
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
            <!--Security Question -->
            <div class="field input">
                <label for="security_question">Security Question</label>
                <select name="security_question" id="security_question" required>
                    <option value="" disabled selected>Select a security question</option>
                    <option value="What is your favorite movie?">What is your favorite movie?</option>
                    <option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
                    <option value="What is the name of your favorite teacher?">What is the name of your favorite teacher?</option>
                    <option value="What is the name of the street you grew up on?">What is the name of the street you grew up on?</option>
                    <option value="What is the name of your favorite childhood friend?">What is the name of your favorite childhood friend?</option>
                    <option value="What is your favorite book?">What is your favorite book?</option>
                    <option value="What was the first concert you attended?">What was the first concert you attended?</option>
                    <option value="What is the name of the company you had your first job at?">What is the name of the company you had your first job at?</option>
                </select>
            </div>
            <div class="field input">
                <label for="security_answer">Security Answer</label>
                <input type="text" name="security_answer" id="security_answer" autocomplete="off" placeholder="Please provide a strong and memorable answer (e.g., avoid using common words or phrases)" required>
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
