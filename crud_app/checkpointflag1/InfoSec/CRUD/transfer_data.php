<?php
// Include database connection file
include('dbcon.php');

// Check if the taskId is set in the POST request
if(isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];

    // Select the task data to be archived from the tasks table
    $select_query = "SELECT * FROM tasks WHERE tasks_id_pk = '$taskId'"; // Updated column name to tasks_id_pk
    $select_result = mysqli_query($connection, $select_query);

    if (!$select_result) {
        die("Select query failed: " . mysqli_error($connection));
    }

    // Fetch the task data
    $row = mysqli_fetch_assoc($select_result);

    // Extract task details
    $archived_title = $row['tasks_title']; // Updated field name
    $archived_notes = $row['tasks_notes']; // Updated field name
    $archived_due_date = $row['tasks_due_date']; // Updated field name

    // Insert data into the archived_tasks table
    $insert_query = "INSERT INTO archived_tasks (archived_tasks_id_pk, archived_title, archived_notes, archived_due_date) 
                     VALUES ('$taskId', '$archived_title', '$archived_notes', '$archived_due_date')"; // Updated column names
    $insert_result = mysqli_query($connection, $insert_query);

    if (!$insert_result) {
        die("Insertion into archived table failed: " . mysqli_error($connection));
    }

    // Return a success message
    echo "Task archived successfully";
} else {
    // If taskId is not provided, return an error message
    echo "Task ID not provided";
}
?>
