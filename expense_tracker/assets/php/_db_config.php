<?php
//DB connection removed for GitHub
    $server_name = "";
    $db_username = "";
    $password = "";
    $db_name = "";
    $failure_msg = '<p class="failure-notice">The Expense Tracker is encountering technical difficulties at this time. Please try again later.</p>';
    $conn = mysqli_connect($server_name, $db_username, $password, $db_name);
    if (!$conn) {
        die($failure_msg);
    }
?>
