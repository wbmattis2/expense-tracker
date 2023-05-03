<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 4: PHP - String Length Indicator</h2>
        <p>
            Measures and displays the length of a string entered by the user.
        </p>
        <form action="" method="post">
            <input type="text" name="string_to_measure" id="string_to_measure"
            <?php 
            if (isset($_POST['string_to_measure'])) {
                echo ' value="'.$_POST['string_to_measure'].'"';
            }
            ?>
            >
            <label for="string_to_measure">String</label><br>

            <input name="length" id="length"
            <?php 
            if (isset($_POST['string_to_measure'])) {
                echo ' value="'.strlen($_POST['string_to_measure']).'"';
            }
            ?>
            >
            <label for="length">Length</label><br>

            <input type="submit" value="Calculate length">
        </form>
    </main>
</body>
</html>