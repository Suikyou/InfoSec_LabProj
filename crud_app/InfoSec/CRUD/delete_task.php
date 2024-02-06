<?php
// Include database connection file
include('dbcon.php');

// Check if the taskId is set in the POST request
if(isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    // Delete the task from the tasks table
    $delete_query = "DELETE FROM tasks WHERE id = '$taskId'";
    $delete_result = mysqli_query($connection, $delete_query);

    if (!$delete_result) {
        // If deletion fails, return an error message
        echo "Error deleting task";
    }

} else {
    // If taskId is not provided, return an error message
    echo "Task ID not provided";
}
?>
