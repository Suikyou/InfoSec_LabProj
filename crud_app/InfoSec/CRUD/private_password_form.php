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
    <!-- Add any necessary CSS stylesheets here -->
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
        </form>
    </div>
</body>
</html>
