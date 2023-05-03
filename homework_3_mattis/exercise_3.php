<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 3: PHP - Multiples-of-4 Enumerator</h2>
        <p>
            Displays all numbers between 200 and 250 (inclusive) that are divisible by 4.
        </p>
        <div class="showcase">
            <?php
            for ($i = 200; $i <= 250; $i++) {
                if ($i % 4 == 0) {
                    echo $i . ', ';
                }
            }
            ?>
        </div>
    </main>
</body>
</html>