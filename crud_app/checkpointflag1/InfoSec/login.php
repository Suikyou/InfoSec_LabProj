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
        <a>Task Man</a>
    </div>
    <ul>
        <li><a href="home.php">Home</a></li>
    </ul>
</nav>

<div class="container">
    <div class="box form-box">
        <?php
        include("config.php");
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);

            // Fetch user from database based on email
            $result = mysqli_query($con, "SELECT * FROM users WHERE user_eadd='$email'") or die("Select Error: " . mysqli_error($con));

            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                // Verify password
                if(password_verify($password, $row['user_pw'])) {
                    // Password is correct
                    $_SESSION['valid'] = $row['user_eadd'];
                    $_SESSION['firstName'] = $row['user_fname'];
                    $_SESSION['lastName'] = $row['user_lname'];
                    $_SESSION['id'] = $row['user_id_pk'];

                    // Redirect to tasks page
                    echo "<script>alert('Account logged in! Redirecting to the tasks page.'); window.location='CRUD/index.php';</script>";
                    exit(); // Stop execution
                } else {
                    // Password is incorrect
                    echo "<script>alert('Wrong Username or Password. Please try again!');</script>";
                }
            } else {
                // User not found
                echo "<script>alert('User not found. Please try again!');</script>";
            }
        }
        ?>
        <header>Login</header>
        <form action="login.php" method="post">
            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" placeholder="Enter email here" required value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
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
