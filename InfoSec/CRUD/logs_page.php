<?php
// Include header and database connection file
include('header.php');
include('dbcon.php');

// Start session
session_start();
if(!isset($_SESSION['valid'])){
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/login.php");
}
?>

<div class="box1">
    <h2>User Logs</h2>
</div>

<div class="table-responsive">
    <table class="table table-hover table-bordered table-striped">
        <thead>
            <tr>
                <th>Action</th>
                <th>Item ID</th>
                <th>Item Type</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch logs of the currently logged-in user
            $user_id = $_SESSION['id']; // Retrieve user ID from session
            $query = "SELECT * FROM user_logs WHERE user_id = $user_id";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($connection));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['action']; ?></td>
                        <td><?php echo $row['item_id']; ?></td>
                        <td><?php echo $row['item_type']; ?></td>
                        <td><?php echo $row['timestamp']; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

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

<?php include('footer.php'); ?>
