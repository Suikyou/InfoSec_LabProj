<?php
// Include database connection file
include('dbcon.php');

// Start session and redirect user to home page
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/home.php");
}

// Check if the tasks_id_pk is set in the POST request
if(isset($_POST['tasks_id_pk'])) {
    $taskId = $_POST['tasks_id_pk'];

    // Delete the task from the tasks table
    $delete_query = "DELETE FROM tasks WHERE tasks_id_pk = ?";
    $stmt = $connection->prepare($delete_query);
    
    // Bind parameter using appropriate type specifier
    $stmt->bind_param("i", $taskId);
    
    // Execute the statement
    $delete_result = $stmt->execute();

    if (!$delete_result) {
        // If deletion fails, return an error message
        echo "Error deleting task: " . $stmt->error;
    } else {
        // If deletion is successful, return a success message
        echo "Task deleted successfully";
    }

} else {
    // If tasks_id_pk is not provided, return an error message
    echo "Task ID not provided";
}
?>
