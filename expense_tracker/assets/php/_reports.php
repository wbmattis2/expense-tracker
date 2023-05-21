<?php
    //using GET method for SELECT queries
    $query_appendage = "";
    $submitted = filter_input(INPUT_GET, "submitted");
    if ($submitted == "submitted") {
        $valid_submission = TRUE;
        $by_name = filter_input(INPUT_GET, "by_name");
        $by_date = filter_input(INPUT_GET, "by_date");
        if ( (empty($by_name) && empty($by_date)) ) {
            echo '<p class="failure-notice">You must click the corresponding checkbox in order to search by item name and/or expense date.</p>';
            $valid_submission = FALSE;
        }
        else {
            if ($by_name == "by_name") {
                $item_name = filter_input(INPUT_GET, "item_name");
                if (empty($item_name) || strlen($item_name) > 15) {
                    echo '<p class="failure-notice">You must enter an item name less than 15 characters long in order to search by item name.</p>';
                    $valid_submission = FALSE;
                }
                else {
                    $stringency_index = filter_input(INPUT_GET, "stringency");
                    $stringency_sql = array(
                        "IS" => (" item_name = '" . mysqli_real_escape_string($conn, $item_name) . "'"),
                        "CONTAINS" => (" item_name LIKE '%" . mysqli_real_escape_string($conn, $item_name) . "%'")
                    );
                    $stringency_natural = array(
                        "IS" => (" Item Name is <span>" . htmlentities($item_name) . "</span>"),
                        "CONTAINS" => (" Item Name contains <span>" . htmlentities($item_name) . "</span>")
                    );
                    $name_query = $stringency_sql[$stringency_index];
                    $name_message = $stringency_natural[$stringency_index];
                }
            }
            if ($by_date == "by_date") {
                $early_date = filter_input(INPUT_GET, "early_date");
                $late_date = filter_input(INPUT_GET, "late_date");
                if (empty($early_date) || empty($late_date) ) {
                    echo '<p class="failure-notice">You must enter beginning and ending dates in order to search by expense date. To search for a single date, enter that date as both the earliest and latest date.</p>';
                    $valid_submission = FALSE;
                }
                else {
                    if ($early_date > $late_date) {
                        $placeholder = $early_date;
                        $early_date = $late_date;
                        $late_date = $placeholder;
                    }
                    $date_query = " expense_date BETWEEN '" . mysqli_real_escape_string($conn, $early_date) . "' AND '" . mysqli_real_escape_string($conn, $late_date) . "'";
                    $date_message = " Expense Date is between <span>" . htmlentities($early_date) . "</span> and <span>" . htmlentities($late_date) . "</span>";
                }
            }
            $conjunction = filter_input(INPUT_GET, "conjunction");
            if ( ( !($conjunction == "AND" || $conjunction == "OR") && !empty($by_date) && !empty($by_name) ) || 
                ( ($conjunction == "AND" || $conjunction == "OR") && ( empty($by_date) || empty($by_name) ) ) ) {
                echo '<p class="failure-notice">In order to search by multiple criteria, you must select the checkbox for a search by date, the checkbox for a search by item name, and a search conjunction (AND or OR).</p>';
                $conjunction = "";
                $valid_submission = FALSE;
            }
            if ($valid_submission) {
                $conjunction = " " . $conjunction;
                $query_appendage .= " AND" . $name_query . $conjunction . $date_query;
            }
        }
    }
    $result = result_array("expenses", $query_appendage); //function defined in _db_toolkit
    if ($valid_submission) {
		if ($result) {
			echo '<p class="success-notice">Your report was run successfully! See below to view your results.</p>';
		}
		else {
        	echo '<p class="failure-notice">Expense Tracker encountered difficulties in running your report. Please try again later.</p>';
    	}
		
	}

?>

<form action="" method="get">
    <span>Specify and submit search criteria to define the report displayed below:</span>
    <br>
    <input type="checkbox" value="by_name" name="by_name">
    <label for="by_name">Find expenses where Item Name...</label>
    <select name="stringency" id="stringency">
        <option value="IS">IS</option>
        <option value="CONTAINS">CONTAINS</option>
    </select>
    <label for="stringency">(Choose a search method)</label>
    <input name="item_name" id="item_name">
    <label for="item_name">(Enter a search term up to 15 characters long)</label>
    <br>
    <br>
    <select name="conjunction" id="conjunction">
        <option name="conjunction" value="" selected="selected"></option>
        <option name="conjunction" value="AND">AND</option>
        <option name="conjunction" value="OR">OR</option>
    </select>
    <label for="conjunction">(Select a conjunction to search by multiple criteria)</label>
    <br>
    <br>
    <input type="checkbox" value="by_date" name="by_date">
    <label for="by_date">Find expenses where Expense Date is between...</label>
    <input type="date" name="early_date" id="early_date">
    <label for="early_date">(earliest date)</label>
    and
    <input type="date" name="late_date" id="late_date">
    <label for="late_date">(latest date)</label>
    <br>
    <input type="hidden" name="select_feature" value="reports">
    <button type="submit" name="submitted" value="submitted">Narrow Down Results</button>
</form>
<?php
    if ( $result ) {
        if ($valid_submission) {
            echo "<p>Now displaying search results where" . $name_message . $conjunction . $date_message . ":</p>";
        }
        else {
            echo "<p>Now displaying all of your recorded expenses:</p>";
        }
        $column_labels = array("Expense Date", "Item Name", "Item Description", "Amount", "Category", "Store");
        array_display($result, $column_labels); //function defined in _db_toolkit
	}
	else {
		echo '<p class="failure-notice">Expense Tracker encountered difficulties in running your report. Please try again later.</p>';
	}
?>