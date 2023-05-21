<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 3.5: Century Calculator</h2>
        <p>
            Displays the century (e.g. "19th Century") of a given year between 1000-2010 (e.g. "1871"), with the beginning of the 11th century starting in 1001.
            Returns "invalid input" if input is non-numeric, non-integer, or out of the specified range (i.e., if the user bypasses built-in form input restrictions).
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $year = filter_input(INPUT_POST, "year");

                function yearToCentury($year) {
                    if (!isset($year)) {
                        return;
                    }
                    else if ( !is_numeric($year) || $year < 1000 || $year > 2010 || floor($year) != ceil($year) ) {
                        return 'invalid input';
                    }
                    else {
                        $century = ceil(($year) / 100);
                        return $century . "th Century";
                    }
                }
                ?>
                <input required type="number" min="1000" max="2010" name="year" id="year" value="<?=$year?>">
                <label for="year">Year between 1000 and 2010</label><br>

                <p>
                    <?=yearToCentury($year)?>
                </p>

                <input type="submit" value="Display Century">
            </form>
        </div>
    </main>
</body>
</html>