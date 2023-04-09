<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 3: PHP - Number Sign Indicator</h2>
        <p>
            Determines and displays the sign of a number entered by the user.
            Displays "NAN" if user input is not numeric.
        </p>
        <form action="" method="post">
        <?php
            function determineSign($signed_number) {
                if ( !is_numeric($signed_number) ) {
                    return "NAN";
                }
                else if ( $signed_number == 0 ) {
                    return "Zero";
                }
                else if ( $signed_number > 0 ) {
                    return "Positive";
                }
                else {
                    return "Negative";
                }
            }
        ?>
            <input name="signed_number" id="signed_number"
        <?php 
            if (isset($_POST['signed_number'])) {
                echo ' value="'.$_POST['signed_number'].'"';
            }
        ?>
            >
            <label for="signed_number">Number</label><br>

            <input name="number_sign" id="number_sign"
            <?php 
            if (isset($_POST['signed_number'])) {
                echo ' value="'.determineSign($_POST['signed_number']).'"';
            }
        ?>
            >
            <label for="number_sign">Sign</label><br>

            <input type="submit" value="Determine sign">
        </form>
    </main>
</body>
</html>