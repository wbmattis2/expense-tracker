<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 1.5: Student Grade Indicator</h2>
        <p>
            Determines and displays grade division based on a given grade percentage entered by the user.
            Displays "Invalid Grade" if user input is negative of non-numeric.
        </p>
        <form action="" method="post">
        <?php
            function gradeDivision($percentage) {
                if (!is_numeric($percentage) || $percentage < 0) {
                    return "Invalid Grade";
                }
                else if ( $percentage >= 60 ) {
                    return "First Division";
                }
                else if ( $percentage >= 45 ) {
                    return "Second Division";
                }
                else if ( $percentage >= 33 ) {
                    return "Third Division";
                }
                else {
                    return "Fail";
                }
            }
        ?>
            <input name="grade_percentage" id="grade_percentage"
            <?php 
            if (isset($_POST['grade_percentage'])) {
                echo ' value="'.$_POST['grade_percentage'].'"';
            }
            ?>
            >
            <label for="grade_percentage">Grade percentage</label><br>

            <input name="grade_division" id="grade_division"
            <?php 
            if (isset($_POST['grade_division'])) {
                echo ' value="'.gradeDivision($_POST['grade_percentage']).'"';
            }
            ?>
            >
            <label for="grade_division">Grade division</label><br>

            <input type="submit" value="Determine grade division">
        </form>
    </main>
</body>
</html>