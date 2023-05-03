<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 6: PHP - Date Difference Calculator</h2>
        <p>
            Calculates and displays the number of days elapsed between two dates provided by the user.
            Displays "invalid input" if two valid dates are not provided.
        </p>
        <form action="" method="post">
        <?php 
        function countDays($firstString, $secondString) {
            if (empty($firstString) || empty($secondString)) {
                return 'invalid input';
            }
            try {
                $firstObject = new DateTime($firstString);
                $secondObject = new DateTime($secondString);
                $diff_array = date_diff($secondObject, $firstObject);
                return 'There are ' . $diff_array->days . ' days between the first and second dates.';
            } catch (Exception $e) {
                return 'invalid input';
            }
        }
        ?>
            <input required type="date" name="first_date" id="first_date"
            <?php 
            if (isset($_POST['first_date'])) {
                echo ' value="'.$_POST['first_date'].'"';
            }
            ?>
            >
            <label for="first_date">First date</label><br>

            <input required type="date" name="second_date" id="second_date"
            <?php 
            if (isset($_POST['second_date'])) {
                echo ' value="'.$_POST['second_date'].'"';
            }
            ?>
            >
            <label for="first_date">Second date</label><br>

            <p>
            <?php 
            if (isset($_POST['second_date']) || isset($_POST['first_date'])) {
                echo countDays($_POST['first_date'], $_POST['second_date']);
            }
            ?>
            </p>

            <input type="submit" value="Calculate">
        </form>
    </main>
</body>
</html>