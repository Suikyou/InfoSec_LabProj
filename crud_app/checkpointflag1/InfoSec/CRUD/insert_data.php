<?php
include 'dbcon.php';
session_start(); // Make sure to start the session

if (isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $notes = $_POST['notes'];

    // Check if 'id' key is set in the session
    if (isset($_SESSION['id'])) {
        // Dynamically retrieve user_id from the session
        $tasks_user_id_fk = $_SESSION['id'];

        $query = "INSERT INTO `tasks` (`tasks_user_id_fk`, `tasks_title`, `tasks_due_date`, `tasks_notes`) 
                  VALUES ('$tasks_user_id_fk', '$title', '$due_date', '$notes')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Error: " . mysqli_error($connection));
        } else {
            // Use header function to redirect to index.php with the message
            $message = '<span style="color: #b04f34;">Task added successfully</span>';
            $message_encoded = urlencode($message);
            header('location:index.php?insert_msg=' . $message_encoded);
        }
    } else {
        die("Error: 'id' key is not set in the session.");
    }
}
?>
