<?php
include("CRUD/dbcon.php");

// Check if the email exists in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE user_eadd = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Email exists
        // You can perform further actions here if needed
        echo 'Email exists';
    } else {
        // Email does not exist
        echo 'Email does not exist';
    }
}

$conn->close();
?>
