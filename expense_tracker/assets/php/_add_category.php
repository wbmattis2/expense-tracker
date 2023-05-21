    <?php
        $categories_array = result_array('categories');
        $new_category = filter_input(INPUT_POST, "new_category");
        $msg_template = filter_input(INPUT_GET, "msg_flag");
        $processed_category = filter_input(INPUT_GET, "processed_category");
        
        if (isset($new_category)) { //determine query string to pass through POST-REDIRECT-GET
            $new_category = strtoupper(trim($new_category));
            if (empty($new_category)) {
                $msg_flag = "empty_cat";
            }
            elseif (strlen($new_category) > 15) {
                $msg_flag = "long_cat";
            }
            elseif (is_duplicate($new_category, "category_name", $categories_array)) {
                $msg_flag = "dup_cat";
            }
            else {
                $new_category = strtoupper($new_category);
                $category_owner_id = id_from_name("user_id", $_SESSION['username']);
                $query = "INSERT INTO expense_categories (category_name, category_owner_id) 
                    VALUES ('".mysqli_real_escape_string($conn, $new_category)."', $category_owner_id)";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $msg_flag = "cat_added";
                }
                else {
                    $msg_flag = "cat_not_added";
                }
            }
            header("Location:index.php?select_feature=add_category&msg_flag=$msg_flag&processed_category=$new_category");
            exit("Redirecting...");
        }
        if (isset($msg_template)) { //use query string to define and display correct response to user submission
            $msg_array = array(
                "empty_cat" => '<p class="failure-notice">New category must not be empty. Please try again.</p>',
                "long_cat" => '<p class="failure-notice">Category name <span>' . htmlentities($processed_category) . '</span> is too long. Category names must be 15 characters or less.</p>',
                "dup_cat" => '<p class="failure-notice">Category <span>' . htmlentities($processed_category) . '</span> already exists.</p>',
                "cat_added" => '<p class="success-notice">New category added: <span>' . htmlentities($processed_category) . '</span>.</p>',
                "cat_not_added" => '<p class="failure-notice">Expense Tracker has encountered a problem and failed to add new category: <span>' . htmlentities($processed_category) . '</span>. Please try again later.</p>'
            );
            echo $msg_array[$msg_template];
        }

        $column_labels = array("Existing Categories:");
        ?>
    <div class="col-container">
        <div class="col-2">
            <form action="" method="POST">
                <label for="new_category"><span>New Category:</span></label>
                <input required type="text" maxlength="15" name="new_category" id="new_category">
                <br>
                <button type="submit">Add Category</button>
            </form>
        </div><!--col-2-->
        <div class="col-2">
        <?php array_display($categories_array, $column_labels); ?>
        </div><!--col-2-->     
    </div><!--col-container-->
