<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 3.1: Years-to-Days Converter</h2>
        <p>
            Calculates and displays the number of days in a given number of years, with one year being counted as 365 days.
            Displays "invalid input" if input is non-numeric or negative.
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $years = filter_input(INPUT_POST, "years");

                function yearsToDays($years) {
                    if ( !isset($years) ) {
                        return;
                    }
                    else if ( !is_numeric($years) || $years < 0 ) {
                        return 'invalid input';
                    }
                    else {
                        return ($years * 365) . " days";
                    }
                }
                ?>
                <input required name="years" id="years" value="<?=$years?>">
                <label for="years">Years</label><br>

                <p>
                    <?=yearsToDays($years)?>
                </p>

                <input type="submit" value="Count Days">
            </form>
        </div>
    </main>