<?php
$current_feature = filter_input(INPUT_GET, "select_feature");
$available_features = array("add_expense" => "Record an Expense", "reports" => "View Expense Report", "add_category" => "Add an Expense Category");
?>
<form action="" method="GET">
    <label for="select_feature">Available Features: </label>
    <select name="select_feature" id="select_feature">
        <?php
        //Blank option only appears if a feature has not already been selected
        if (!isset($current_feature) || $current_feature === "") {
            echo '<option name="select_feature" value="" selected="selected"></option>';
        }
        foreach($available_features as $value => $display) {
            $selected = ($value === $current_feature) ? 'selected="selected"' : '';
            echo '<option name="select_feature" value="' . $value . '" ' . $selected . '>' . $display . '</option>'; 
        }
        ?>
    </select>
    <button type="submit">Use Feature</button>
</form>
<?php
//Locate and include the feature component selected by the user
$feature_location = "./assets/php/_" . $current_feature . ".php";
echo "<hr><h2>" . $available_features[$current_feature] . "</h2>";
include($feature_location);
?>