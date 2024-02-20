<?php
session_start();

// Include database connection file
include('dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered email and password
    $entered_email = $_POST["email"];
    $entered_password = $_POST["password"];

    // Fetch user details from the database
    $query = "SELECT * FROM users WHERE user_eadd = '$entered_email'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $stored_password = $user['user_pw'];

        // Verify the entered password
        if (password_verify($entered_password, $stored_password)) {
            // Set session variable to indicate successful authentication
            $_SESSION['valid_user'] = true;
            
            // Redirect to the private page
            header("Location: priv_tasks.php");
            exit;
        } else {
            $error_message = "Invalid email or password. Please try again.";
        }
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
            background-color: #26334e; /* Change background color */
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 100px; /* Adjust spacing from top */
            text-align: center;
        }

        h2 {
            color: #e7dbb9; /* Change color of h2 tag */
        }

        .form-group {
            margin-bottom: 20px; /* Adjust spacing between form groups */
            text-align: center; /* Center align form group content */
        }

        label {
            color: #e7dbb9; /* Change label text color */
            display: block; /* Display labels as block elements */
            margin-bottom: 5px; /* Add space below labels */
            text-align: left; /* Align label text to left */
            margin-left: 530px;
        }

        input[type="email"],
        input[type="password"] {
            width: 30%; /* Adjust width of input fields */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            display: block; /* Display inputs as block elements */
            margin: 0 auto; /* Center align input fields */
        }

        button[type="submit"] {
            background-color: #086bae; /* Change button background color */
            color: white; /* Change button text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #075d9b; /* Darken button color on hover */
        }

        button[type="button"] {
            background-color: #555; /* Change back button background color */
            color: white; /* Change back button text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px; /* Adjust margin from the top */
        }

        button[type="button"]:hover {
            background-color: #333; /* Darken back button color on hover */
        }

        p {
            color: #ff0000; /* Change error message color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Please Log In</h2>
        <?php if(isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Log In</button>
            <button type="button" onclick="window.location.href='index.php'">Back</button>
        </form>
    </div>
</body>
</html>
