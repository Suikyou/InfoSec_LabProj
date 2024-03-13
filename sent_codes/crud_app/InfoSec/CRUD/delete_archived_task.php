<?php
// Include the database connection
include('dbcon.php');

// Start session and redirect user to home page
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/home.php");
}

// Check if the task ID is set and not empty
if(isset($_POST['task_id']) && !empty($_POST['task_id'])) {
    // Sanitize the task ID to prevent SQL injection
    $task_id = mysqli_real_escape_string($connection, $_POST['task_id']);

    // Query to delete the task from the archived_tasks table
    $query = "DELETE FROM archived_tasks WHERE archived_tasks_id_pk = '$task_id'";

    // Execute the query
    if(mysqli_query($connection, $query)) {
        // Log the deletion operation
        $log_action = 'delete';
        $item_type = 'archived_task';
        $insert_log_query = "INSERT INTO user_logs (user_id, action, item_id, item_type) VALUES (?, ?, ?, ?)";
        $stmt_log = $connection->prepare($insert_log_query);
        $stmt_log->bind_param("isss", $_SESSION['id'], $log_action, $task_id, $item_type);
        $stmt_log->execute();
        $stmt_log->close();

        // Return a success message
        header("Location: archived_tasks.php?message=Task deleted successfully");
        exit();
    } else {
        // If deletion fails, redirect back to the archived tasks page with an error message
        header("Location: archived_tasks.php?error=Failed to delete task");
        exit();
    }
} else {
    // If the task ID is not set or empty, redirect back to the archived tasks page with an error message
    header("Location: archived_tasks.php?error=Task ID not provided");
    exit();
}
?>
