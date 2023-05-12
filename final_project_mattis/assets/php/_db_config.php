<?php
    $server_name = "sql204.epizy.com";
    $db_username = "epiz_33462326";
    $password = "7HftIipyV";
    $db_name = "epiz_33462326_tech282";
    $failure_msg = '<p class="failure-notice">The Expense Tracker is encountering technical difficulties at this time. Please try again later.</p>';
    $conn = mysqli_connect($server_name, $db_username, $password, $db_name);
    if (!$conn) {
        die($failure_msg);
    }
?>