<?php
        $msg_template = filter_input(INPUT_GET, "msg_flag");
        $data_submitted = filter_input(INPUT_POST, "data_submitted");
        $expense_data = array(
            "expense_date" => trim(filter_input(INPUT_POST, "expense_date")),
            "amount" => trim(filter_input(INPUT_POST, "amount")),
            "item_name" => trim(filter_input(INPUT_POST, "item_name")),
            "item_description" => trim(filter_input(INPUT_POST, "item_description")),
            "store_name" => trim(filter_input(INPUT_POST, "store_name")),
            "category_name" => trim(filter_input(INPUT_POST, "category_name")),
        );
        
        function sanitize_expense(&$expense_data) { //Attempt to mutate expense data to prepare for SQL insert
            $validation_msg = "";
            foreach ($expense_data as $field => $value) {
                if (strlen($value) > 15) {
                    if ($field != "item_description") {
                        $validation_msg .= '<p class="failure-notice">Your entry for <span>' . $field . '</span> must be 15 characters or less.</p>';
                    }
                    elseif (strlen($value) > 45) {
                        $validation_msg .= '<p class="failure-notice">Your entry for <span>' . $field . '</span> must be 45 characters or less.</p>';
                    }
                }
                if ( $field == "amount" && (!preg_match('/^\d{0,12}(\.\d{0,2})?$/', $value) ) ) {
                    $validation_msg .= '<p class="failure-notice">Your entry for <span>' . $field . '</span> must be a positive number less than 1 trillion with up to two decimal places.</p>';
                }
            }
            $expense_data['category_id'] = id_from_name('category_id', $expense_data['category_name']);
            unset($expense_data['category_name']);
            $expense_data['store_id'] = id_from_name('store_id', $expense_data['store_name']);
            unset($expense_data['store_name']);
            
            return $validation_msg;
        }
        if (!empty($data_submitted)) {
            $validation_msg = sanitize_expense($expense_data);
            echo $validation_msg;
            if (empty($validation_msg)) { //If data was successfully mutated, execute query and pass message through POST-REDIRECT-GET
                $expense_data["user_id"] = id_from_name('user_id', $_SESSION["username"]);
                $expense_keys = implode(array_keys($expense_data), ", ");
                $query = "INSERT INTO `expenses` (`expense_id`,
                    `expense_date`,
                    `item_name`, 
                    `item_description`, 
                    `amount`, 
                    `user_id`, 
                    `category_id`, 
                    `store_id`) 
                    VALUES (NULL, ".
                        "'".$expense_data['expense_date']."', ".
                        "'".$expense_data['item_name']."', ".
                        "'".$expense_data['item_description']."', ".
                        "'".$expense_data['amount']."', ".
                        "'".$expense_data['user_id']."', ".
                        "'".$expense_data['category_id']."', ".
                        "'".$expense_data['store_id']."'".
                    ")";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $msg_flag = "success";
                }
                else {
                    $msg_flag = "failure";
                }
                header("Location:index.php?select_feature=add_expense&msg_flag=$msg_flag");
                exit("Redirecting...");
            }
        }
        if (isset($msg_template)) { //use query string to define and display correct response to user submission
            $msg_array = array(
                "success" => '<p class="success-notice">New expense added. <a href="./index.php?select_feature=reports">View Expense Report</a></p>',
                "failure" => '<p class="failure-notice">Expense Tracker encountered a problem and failed to add the new expense. Please try again later.</p>'
            );
            echo $msg_array[$msg_template];
        }
    ?>
    <form id="add-expense-form" action="" method="POST">
        <label for="date"><span>Expense Date: </span></label>
        <input required type="date" name="expense_date" id="expense_date">
        <br>
        <label for="amount"><span>Expense Amount: </span></label>
        <input required name="amount" id="amount" maxlength="15">
        <br>
        <label for="item_name"><span>Item Name (up to 15 characters): </span></label>
        <input required name="item_name" id="item_name" maxlength="15">
        <br>
        <label for="item_description"><span>Item Description (up to 45 characters): </span></label>
        <br>
        <textarea required name="item_description" id="item_description" rows="3" maxlength="45"></textarea>
        <br>
        <label for="category_name"><span>Category Name (up to 15 characters): </span></label>
        <input required list="category_list" name="category_name" id="category_name" maxlength="15">
        <datalist id="category_list">
            <?php
            $categories = result_array('categories');
                foreach ($categories as $row) {
                    echo '<option value="' . $row["category_name"] . '">';
            }
            ?>
        </datalist>
        <br>
        <label for="store_name"><span>Optional &mdash; Store Name (up to 15 characters): </span></label>
        <input name="store_name" list="store_list" id="store_name" maxlength="15">
        <datalist id="store_list">
            <?php
            $stores = result_array('stores');
                foreach ($stores as $row) {
                    echo '<option value="' . $row["store_name"] . '">';
            }
            ?>
        </datalist>
        <br>
        <button type="submit" name="data_submitted" value="data_submitted">Submit Expense</button>
    </form>
