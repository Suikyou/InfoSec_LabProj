<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>  

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM tasks WHERE tasks_id_pk = '$id'"; // Updated column name to tasks_id_pk
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

    $query = "UPDATE tasks SET tasks_title = '$title', tasks_due_date = '$due_date', tasks_notes = '$notes' WHERE tasks_id_pk = '$idnew'"; // Updated column names
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location:index.php?update_msg=Task updated successfully');
    }
}
?>

<form action="update_task.php?id_new=<?php echo $id; ?>" method="post" onsubmit="return confirm('Are you sure you want to update this task?')">
    <div class="form-group">
        <label for="title"> Title </label>
        <input type="text" name="title" class="form-control" value="<?php echo $row['tasks_title'] ?>" required> <!-- Updated field name -->
    </div>
    <div class="form-group">
        <label for="due_date"> Due Date </label>
        <input type="datetime-local" name="due_date" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row['tasks_due_date'])); ?>" required> <!-- Updated field name -->
        <small id="dateWarning" class="text-danger" style="display: none;">Please select a future date and time.</small>
    </div>
    <div class="form-group">
        <label for="notes"> Notes </label>
        <textarea name="notes" class="form-control"><?php echo $row['tasks_notes'] ?></textarea> <!-- Updated field name -->
    </div>
    <input type="submit" class="btn btn-success" name="update_task" value="Update">
</form>

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

<?php include('footer.php'); ?>

