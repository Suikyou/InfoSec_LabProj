<?php
include 'dbcon.php';
session_start(); // Make sure to start the session
var_dump($_SESSION);

if (isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $due_date = $_POST['due_date'];
    $notes = $_POST['notes'];

    if ($title == "" || empty($title)) {
        header('location:index.php?message=You need to fill in the Title');
    } else {
        // Check if 'id' key is set in the session
        if(isset($_SESSION['id'])) {
            // Dynamically retrieve user_id from the session
            $user_id = $_SESSION['id'];

            $query = "INSERT INTO `tasks` (`user_id`, `title`, `due_date`, `notes`) VALUES ('$user_id', '$title', '$due_date', '$notes')";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Error: " . mysqli_error($connection));
            } else {
                header('location:index.php?insert_msg=Your data has been added');
            }
        } else {
            die("Error: 'id' key is not set in the session.");
        }
    }
}
?>
