<?php
// Include header and database connection file
include('header.php');
include('dbcon.php');

// Start session
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/login.php");
}
?>

<div class="box1">
    <h2>Archived Tasks</h2>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Due Date</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if $connection is set and not null
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM archived_tasks";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($connection));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['archived_title']; ?></td>
                    <td><?php echo $row['archived_due_date']; ?></td>
                    <td><?php echo $row['archived_notes']; ?></td>
                    <td>
                        <form action="delete_archived_task.php" method="post">
                            <input type="hidden" name="task_id" value="<?php echo $row['archived_tasks_id_pk']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </tbody>
</table>

<!-- Back Button -->
<div class="buttons">
    <a href="index.php" class="btn btn-primary">Back</a>
</div>

<?php include('footer.php'); ?>
