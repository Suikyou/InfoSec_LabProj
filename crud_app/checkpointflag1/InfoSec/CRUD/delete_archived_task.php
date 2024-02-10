<?php
// Include the database connection
include('dbcon.php');

// Check if the task ID is set and not empty
if(isset($_POST['task_id']) && !empty($_POST['task_id'])) {
    // Sanitize the task ID to prevent SQL injection
    $task_id = mysqli_real_escape_string($connection, $_POST['task_id']);

    // Query to delete the task from the archived_tasks table
    $query = "DELETE FROM archived_tasks WHERE archived_tasks_id_pk = '$task_id'";

    // Execute the query
    if(mysqli_query($connection, $query)) {
        // If deletion is successful, redirect back to the archived tasks page with a success message
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
