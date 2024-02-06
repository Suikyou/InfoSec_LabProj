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
    <h2>Archived Tasks</h2>
    <div class="buttons">
        <!-- Logout Button -->
        <form action="logout.php" method="post">
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
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
                            <input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<!-- Back Button -->
<div class="buttons">
    <a href="index.php" class="btn btn-primary">Back</a>
</div>

<?php include('footer.php'); ?>
