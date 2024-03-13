
<?php include('dbcon.php'); 
// Start session and redirect user to home page
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/home.php");
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Private Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <a>Task Man</a>
    </div>
    <ul>
    </ul>
</nav>
<br><br><br><br>

<div class="container">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM private_tasks WHERE private_tasks_id_pk = '$id'"; // Updated table name and column name to private_tasks_id_pk
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            $row = mysqli_fetch_assoc($result);
        }
    }
    ?>

    <?php
    if (isset($_POST['update_task'])) {
        if (isset($_GET['id_new'])) {
            $idnew = $_GET['id_new'];
        }

        $title = $_POST['title'];
        $due_date = $_POST['due_date'];
        $notes = $_POST['notes'];

        $query = "UPDATE private_tasks SET private_tasks_title = '$title', private_tasks_due_date = '$due_date', private_tasks_notes = '$notes' WHERE private_tasks_id_pk = '$idnew'"; // Updated table name and column names
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            // Redirect to priv_tasks.php with success message
            header('location: priv_tasks.php?update_msg=Task updated successfully');
            exit(); // Ensure script stops here
        }
    }
    ?>

<form action="update_task_priv.php?id_new=<?php echo $id; ?>" method="post" onsubmit="return confirm('Are you sure you want to update this task?')">
    <div class="form-group">
        <label for="title" style="color: #e7dbb9;"> Title </label>
        <input type="text" name="title" class="form-control" value="<?php echo $row['private_tasks_title'] ?>" required> <!-- Updated field name -->
    </div>
    <div class="form-group">
        <label for="due_date" style="color: #e7dbb9;"> Due Date </label>
        <input type="datetime-local" name="due_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row['private_tasks_due_date'])); ?>" required> <!-- Updated field name -->
        <small id="dateWarning" class="text-danger" style="display: none;">Please select a future date and time.</small>
    </div>
    <div class="form-group">
        <label for="notes" style="color: #e7dbb9;"> Notes </label>
        <textarea name="notes" class="form-control"><?php echo $row['private_tasks_notes'] ?></textarea> <!-- Updated field name -->
    </div>
    <input type="submit" class="btn btn-success" name="update_task" value="Update">
</form>

</div>

<?php include('footer.php'); ?>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dueDateInput = document.getElementsByName('due_date')[0];
        dueDateInput.addEventListener('input', function() {
            validateDate(this);
        });

        function validateDate(input) {
            var selectedDate = new Date(input.value);
            var currentDate = new Date();

            if (selectedDate <= currentDate) {
                document.getElementById('dateWarning').style.display = 'block';
                input.setCustomValidity('Cannot select a date and time that is past now.');
            } else {
                document.getElementById('dateWarning').style.display = 'none';
                input.setCustomValidity('');
            }
        }
    });
</script>
