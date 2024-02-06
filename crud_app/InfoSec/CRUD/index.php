<?php include('header.php'); ?>
<?php include('dbcon.php'); ?>  

<style>
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
    }
</style>

<div class="box1">
    <h2>Task Index</h2>
    <div class="buttons">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add Task </button>
        <!-- Logout Button -->
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
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
        $query = "SELECT * FROM tasks";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['due_date']; ?></td>
                    <td><?php echo getTimeRemaining($row['due_date']); ?></td>
                    <td><?php echo $row['notes']; ?></td>
                    <td><a href="update_task.php?id=<?php echo $row['id']; ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to update this task?')">Update</a></td>
                    <td><a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a></td>
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
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    </tbody>
</table>

<?php
if (isset($_GET['message'])) {
    echo "<h6>" . $_GET['message'] . "</h6>";
}
?>
<?php
if (isset($_GET['insert_msg'])) {
    echo "<h6>" . $_GET['insert_msg'] . "</h6>";
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
<form action="insert_data.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <!-- Set min attribute to current date and time -->
                        <input type="datetime-local" name="due_date" class="form-control" min="<?php echo date('Y-m-d\TH:i'); ?>" oninput="validateDate(this)">
                        <small id="dateWarning" class="text-danger" style="display: none;">Please select a future date and time.</small>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea name="notes" class="form-control"></textarea>
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

<script>
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
</script>

<?php include('footer.php'); ?>
