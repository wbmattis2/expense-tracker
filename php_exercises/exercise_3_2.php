<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 3.2: Hours-and-Minutes-to-Seconds Converter</h2>
        <p>
            Calculates and displays the number of seconds in a given number of hours and minutes.
            Displays "invalid input" if either input is non-numeric.
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $hours = filter_input(INPUT_POST, "hours");
                $minutes = filter_input(INPUT_POST, "minutes");

                function hrsMinsToSecs($hours, $minutes) {
                    if ( !isset($hours) || !isset($minutes) ) {
                        return;
                    }
                    else if ( !is_numeric($hours) || !is_numeric($minutes) ) {
                        return 'invalid input';
                    }
                    else {
                        return (60 * ($minutes + 60 * $hours)) . " seconds";
                    }
                }
                ?>
                <input required name="hours" id="hours" value="<?=$hours?>">
                <label for="hours">Hours</label><br>

                <input required name="minutes" id="minutes" value="<?=$minutes?>">
                <label for="minutes">Minutes</label><br>

                <p>
                    <?=hrsMinsToSecs($hours, $minutes)?>
                </p>

                <input type="submit" value="Count Seconds">
            </form>
        </div>
    </main>
</body>
</html>