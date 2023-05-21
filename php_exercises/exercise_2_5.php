<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 2.5: Numbered Table Generator</h2>
        <p>
            Displays a 10x10 table with cells numbered from 1-100 (left to right, then top to bottom) in their content.
        </p>
        <div class="showcase">
            <table class="showcase">
            <?php
            for ($i = 0; $i <= 9; $i++) {
                echo '<tr>';
                for ($j = 1; $j <= 10; $j++) {
                    echo '<td>' . (10 * $i + $j) . '</td>';
                }
                echo '</tr>';
            }
            ?>
            </table>
        </div>
    </main>
</body>
</html>