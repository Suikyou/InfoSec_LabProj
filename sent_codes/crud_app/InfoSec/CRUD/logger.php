<?php
function logAction($connection, $user_id, $log_action, $item_id, $item_type) {
    $insert_log_query = "INSERT INTO user_logs (user_id, action, item_id, item_type) VALUES (?, ?, ?, ?)";
    $stmt_log = mysqli_prepare($connection, $insert_log_query);
    mysqli_stmt_bind_param($stmt_log, "isss", $user_id, $log_action, $item_id, $item_type);
    mysqli_stmt_execute($stmt_log);
    mysqli_stmt_close($stmt_log);
}
?>
