<?php
include 'dbcon.php';
session_start(); // Start the session

if (isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $notes = $_POST['notes'];

    // Check if 'private_user_id_fk' key is set in the session
    if (isset($_SESSION['id'])) {
        // Dynamically retrieve private_user_id_fk from the session
        $private_user_id_fk = $_SESSION['id'];

        // Prepare the SQL query to insert a new task
        $query = "INSERT INTO private_tasks (private_user_id_fk, private_tasks_title, private_tasks_due_date, private_tasks_notes) 
                  VALUES ('$private_user_id_fk', '$title', '$due_date', '$notes')";

        // Execute the query
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Error: " . mysqli_error($connection));
        } else {
            // Redirect to index.php with a success message
            $message = '<span style="color: #b04f34;">Task added successfully</span>';
            $message_encoded = urlencode($message);
            header('location:priv_tasks.php?insert_msg=' . $message_encoded);
            exit(); // Make sure to exit after redirecting
        }
    } else {
        die("Error: 'private_user_id_fk' key is not set in the session.");
    }
}
?>
