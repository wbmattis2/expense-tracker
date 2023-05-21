<?php

function id_from_name($id_field, $name, $stop_recursion = FALSE) { 
//If $stop_recursion is set to FALSE, a new record will be created to provide ids for names that do not already exist in the database.
//If it is set to TRUE, function will return NULL for names that do not already exist in the database.
    global $conn;
    switch ($id_field) {
        case "category_id":
            $query = "SELECT category_id FROM expense_categories WHERE category_name = '".mysqli_real_escape_string($conn, $name)."'";
            break;
        case "store_id":
            $query = "SELECT store_id FROM store_names WHERE store_name = '".mysqli_real_escape_string($conn, $name)."'";
            break;
        case "user_id":
            $query = "SELECT user_id FROM registered_users WHERE username = '".mysqli_real_escape_string($conn, $name)."'";
            break;
        default: 
            return;
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) { //If the name is in the database, return its id.
        return mysqli_fetch_assoc($result)[$id_field];
    }
    elseif ($stop_recursion) {
        return;
    }
    else { //Create a new record and then try again to get an id from the given name.
        switch ($id_field) {
            case "category_id":
                $name = strtoupper($name);
                $query = "INSERT INTO expense_categories (category_id, category_name) VALUES (NULL, '".mysqli_real_escape_string($conn, $name)."')";
                break;
            case "store_id":
                $name = strtoupper($name);
                $query = "INSERT INTO store_names (store_id, store_name) VALUES (NULL, '".mysqli_real_escape_string($conn, $name)."')";
                break;
            case "user_id":
                $name = strtolower($name);
                $query = "INSERT INTO registered_users (user_id, username) VALUES (NULL, '".mysqli_real_escape_string($conn, $name)."')";
                break;
            default: 
                return;
        }
        $result = mysqli_query($conn, $query);
        if ($result) {
            return id_from_name($id_field, $name, TRUE);
        }
        else {//Displays a message and returns NULL if the function does not work as intended.
            exit('<p class="failure-notice">Expense Tracker encountered a problem. Please try again later.</p>');
        }
    } 
}

function result_array($subject, $query_appendage = "") {
//Gets results for queries commonly used in the Expense Tracker app.
//Returns a mysqli_results object.
    global $conn;
    switch ($subject) {
        case "categories":
            $query = "SELECT category_name 
                FROM expense_categories 
                WHERE category_owner_id = ".id_from_name('user_id', $_SESSION['username']).
                " OR category_owner_id IS NULL 
                ORDER BY category_name ASC";
            $result = mysqli_query($conn, $query);
            break;
        case "stores":
            $query = "SELECT store_name FROM store_names ORDER BY store_name ASC";
            $result = mysqli_query($conn, $query);
            break;
        case "expenses":
            $current_username = $_SESSION['username'];
            $query = "SELECT expenses.expense_date, expenses.item_name, expenses.item_description, expenses.amount, expense_categories.category_name, store_names.store_name
                FROM expenses 
                JOIN registered_users ON registered_users.user_id = expenses.user_id 
                JOIN expense_categories ON expense_categories.category_id = expenses.category_id 
                JOIN store_names ON store_names.store_id = expenses.store_id
                WHERE registered_users.username = '".mysqli_real_escape_string($conn, $current_username)."'";
            if (isset($query_appendage)) {
                $query .= $query_appendage;
            }
            $query .= " ORDER BY expenses.expense_date ASC";
            $result = mysqli_query($conn, $query);
            break;
        default:
            $result = NULL;
            break;
    }
    return $result;
}

function array_display($result_array, $column_labels) {
//Displays tables commonly used in the Expense Tracker app and allows users to download a CSV file of the results. 
//Takes a mysqli_result object (possibly returned from result_array()) and a numeric array of strings (column labels) as arguments.
    if (mysqli_num_rows($result_array) > 0) {
        $comma_separated = "";
        echo "<table><thead><tr>";
        foreach ($column_labels as $label) {
            echo "<th>$label</th>";
            $comma_separated .= "$label,";
        }
        echo "</tr></thead><tbody>";
        $comma_separated = trim($comma_separated, ",");
        $comma_separated .= "\n";
        foreach ($result_array as $row) {
            echo "<tr>"; 
            foreach($row as $column => $value) {
                if ($column == "amount") {
                    echo '<td class="align-right">$' . number_format($value, 2) . '</td>';
                }
                else {
                    echo "<td>" . htmlentities($value) . "</td>";
                }
                $comma_separated .= "$value,";
            }
            echo "</tr>";
            $comma_separated = trim($comma_separated, ",");
            $comma_separated .= "\n";
        } 
        echo "</tbody></table>";
    	$comma_separated = trim($comma_separated, ",");
        $filename = $_SESSION['filename'] . ".csv";
        ?>
        <form action="download.php" target="_blank" method="post">
            <input type="hidden" name="csv_filename" value="<?=$filename?>">
            <input type="hidden" name="csv_contents" value="<?=$comma_separated?>">
            <input type="submit" name="submit" value="Download Table" title="Download this table as a .csv (comma-separated values) document">
        </form>
        <?php
    }
    else {
        echo '0 results.';
    }
}

function is_duplicate($new_value, $key_column, $old_results) {
//Checks whether $new_value is a duplicate in string $key_column of mysqli_result object $old_results
    foreach ($old_results as $row) {
        foreach ($row as $column => $old_value) {
            if ($column == $key_column && $old_value == $new_value) {
                return TRUE;
            }
        }
    }
    return FALSE;
}

?>

