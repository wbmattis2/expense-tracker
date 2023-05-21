<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 2.4: Sum of Integers Calculator</h2>
        <p>
            Adds all integers between 0 and 30 (inclusive) and displays the total.
        </p>
        <div class="showcase">
            <?php
            $total = 0;
            for ($i = 0; $i <= 30; $i++) {
                $total += $i;
            }
            echo 'The sum of all the integers between 0 and 30 (inclusive) is: '.$total;
            ?>
        </div>
    </main>
</body>
</html>