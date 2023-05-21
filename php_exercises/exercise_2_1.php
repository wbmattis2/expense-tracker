<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 2.1: Day-of-the-Week Indicator</h2>
        <p>
            Calculates and displays the day of the week (Monday, Tuesday, Wednesday, etc.).
            Displays "invalid input" if client's data is not parsable.
        </p>
        <div class="showcase">
            Day of the Week: 
            <?php
            $today = new DateTime();
            $baseline = new DateTime('2023-04-09');
            $days_elapsed = date_diff($today, $baseline)->d;
            $current_day = $days_elapsed % 7;
            switch ($current_day) {
                case 1:
                    echo 'Monday';
                    break;
                case 2:
                    echo 'Tuesday';
                    break;
                case 3:
                    echo 'Wednesday';
                    break;
                case 4: 
                    echo 'Thursday';
                    break;
                case 5:
                    echo 'Friday';
                    break;
                case 6:
                    echo 'Saturday';
                    break;
                case 7:
                    echo 'Sunday';
                    break;
                default:
                    echo 'invalid input';
                }
            ?>
        </div>
    </main>