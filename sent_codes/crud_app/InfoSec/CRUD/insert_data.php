<?php
// Include database connection file
include('dbcon.php');

// Start session and redirect user to home page
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/home.php");
}

if (isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $notes = $_POST['notes'];

    // Check if 'id' key is set in the session
    if (isset($_SESSION['id'])) {
        // Dynamically retrieve user_id from the session
        $tasks_user_id_fk = $_SESSION['id'];

        // Prepare the insert query
        $query = "INSERT INTO `tasks` (`tasks_user_id_fk`, `tasks_title`, `tasks_due_date`, `tasks_notes`) 
                  VALUES (?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $connection->prepare($query);

        // Bind parameters
        $stmt->bind_param("isss", $tasks_user_id_fk, $title, $due_date, $notes);

        // Execute the statement
        $result = $stmt->execute();

        // Check if the query was executed successfully
        if ($result) {
            // Retrieve the ID of the inserted task
            $task_id = $stmt->insert_id;

            // Log the insert operation
            $log_action = 'User created a';
            $item_type = 'Task';
            
            $insert_log_query = "INSERT INTO user_logs (user_id, action, item_id, item_type) VALUES (?, ?, ?, ?)";
            $stmt_log = $connection->prepare($insert_log_query);
            $stmt_log->bind_param("isss", $_SESSION['id'], $log_action, $task_id, $item_type);
            $stmt_log->execute();
            $stmt_log->close();

            // Redirect to index.php with success message
            $message = '<span style="color: #b04f34;">Task added successfully</span>';
            $message_encoded = urlencode($message);
            header('location:index.php?insert_msg=' . $message_encoded);
            exit(); // Terminate the script
        } else {
            // If the query fails, display an error message
            die("Error: " . $connection->error);
        }
    } else {
        die("Error: 'id' key is not set in the session.");
    }
} else {
    // If the 'add_task' parameter is not set in the POST request
    die("Error: 'add_task' parameter is not set.");
}
?>
