<?php
// Include header and database connection file
include('dbcon.php');

// Start session
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Private Task Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito Sans', sans-serif;
            background-color: #26334e; /* Change background color */
        }

        h2 {
            color: #e7dbb9; /* Change color of h2 tag */
        }

        nav {
            background-color: white; /* Set background color to white */
            height: 60px;
            display: flex;
            justify-content: space-between; /* Change to space-between to move branding to the left */
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            text-decoration: none;
            border-bottom: 1px solid black; /* Add border under the navbar */
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end; /* Change to flex-end to align items to the right */
            align-items: center;
        }

        nav li {
            display: inline-block;
            margin: 0 10px;
            text-decoration: none;
            border-right: 1px solid black; /* Add border between anchors */
            padding-right: 10px; /* Add padding to separate anchors visually */
        }

        nav li:last-child {
            border-right: none; /* Remove border from last anchor */
        }

        nav a {
            color: black;
            text-decoration: none;
            padding: 10px;
            position: relative;
        }

        nav a:after {
            content: "";
            height: 3px;
            background-color: #f1c40f;
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            opacity: 0;
            transition: opacity 0.3s, transform 0.3s;
            transform: scaleX(0);
        }

        nav a:hover:after {
            opacity: 1;
            transform: scaleX(1);
        }

        .branding {
            margin-left: 20px; /* Adjust as needed to move the branding further left */
        }

        .branding a {
            color: black;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }

        .box1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .box1 .buttons {
            display: flex;
        }

        .box1 .buttons button {
            margin-right: 10px;
            background-color: #086bae; /* Change button background color */
            border-color: #086bae; /* Change button border color */
            color: white; /* Change button text color */
        }
    </style>
</head>
<body>

<nav>
    <div class="branding">
    </div>
    <ul>
        <li><a> </a></li>
        <li><a href="index.php">Leave Private Mode</a></li>
        <li><a href="logout.php">Log Out</a></li>
    </ul>
</nav>
<br><br><br><br>

<div class="container">
    <div class="box1">
        <h2>Task Index</h2>
        <div class="buttons">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add Task </button>
            <!-- Logout Button -->
        </div>
    </div>

    <table class="table table-hover table-bordered table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Due Date</th>
            <th>Time Remaining</th>
            <th>Notes</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM private_tasks";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['private_tasks_title']; ?></td>
                    <td><?php echo $row['private_tasks_due_date']; ?></td>
                    <td><?php echo getTimeRemaining($row['private_tasks_due_date']); ?></td>
                    <td><?php echo $row['private_tasks_notes']; ?></td>
                    <td><a href="update_task.php?id=<?php echo $row['private_tasks_id_pk']; ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to update this task?')">Update</a></td>
                    <td><button class="delete-button btn btn-danger" data-task-id="<?php echo $row['private_tasks_id_pk']; ?>">Delete</button></td>
                </tr>
                <?php
            }
        }

        function getTimeRemaining($dueDate) {
            $currentTime = time();
            $dueTime = strtotime($dueDate);
            $timeRemaining = $dueTime - $currentTime;

            // Check if the task is overdue
            if ($timeRemaining < 0) {
                return 'Overdue';
            }

            // Convert time remaining to human-readable format
            $days = floor($timeRemaining / (60 * 60 * 24));
            $hours = floor(($timeRemaining % (60 * 60 * 24)) / (60 * 60));
            $minutes = floor(($timeRemaining % (60 * 60)) / 60);

            return "$days days, $hours hours, $minutes minutes";
        }
        ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['message'])) {
        echo "<h6>" . $_GET['message'] . "</h6>";
    }
    ?>
    <?php
    if (isset($_GET['insert_msg'])) {
        $message = html_entity_decode($_GET['insert_msg']);
        echo "<h6>" . $message . "</h6>";
    }
    ?>
    <?php
    if (isset($_GET['update_msg'])) {
        echo "<h6>" . $_GET['update_msg'] . "</h6>";
    }
    ?>
    <?php
    if (isset($_GET['archive_msg'])) {
        echo "<h6>" . $_GET['archive_msg'] . "</h6>";
    }
    ?>

    <!-- Modal -->
    <form action="insert_data_priv.php" method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Type the title of your task here">
                        </div>
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <!-- Set min attribute to current date and time -->
                            <input type="datetime-local" name="due_date" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" oninput="validateDate(this)" placeholder="Select a due date and time">
                            <small id="dateWarning" class="text-danger" style="display: none;">Please select a future date and time.</small>
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea name="notes" class="form-control" placeholder="Type your notes here"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                        <input type="submit" class="btn btn-success" name="add_task" value="ADD">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-button').click(function() {
                var taskId = $(this).data('task-id');

                // Ask for confirmation before deleting the task
                var confirmDelete = confirm("Are you sure you want to delete this task?");
                if (confirmDelete) {
                    // Make AJAX request to delete_task.php
                    $.ajax({
                        url: 'delete_data_priv.php',
                        type: 'POST',
                        data: { private_tasks_id_pk: taskId },
                        success: function(response) {
                            alert(response);

                            // Reload the page to reflect changes
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            alert('Error deleting task');
                        }
                    });
                }
            });

            function validateDate(input) {
                var selectedDate = new Date(input.value);
                var currentDate = new Date();

                if (selectedDate <= currentDate) {
                    document.getElementById('dateWarning').style.display = 'block';
                } else {
                    document.getElementById('dateWarning').style.display = 'none';
                }
            }

            function closeModal() {
                $('#exampleModal').modal('hide');
            }

            // Add event listener for close button
            document.getElementById('closeModal').addEventListener('click', function() {
                closeModal();
            });
        });
    </script>

    <?php include('footer.php'); ?>
</div>

</body>
</html>
