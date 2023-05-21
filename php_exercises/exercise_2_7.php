<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 2.7: Age Calculator</h2>
        <p>
            Calculates and displays the age of the user based on date of birth provided by the user.
            Displays "invalid input" if a valid date of birth is not provided.
        </p>
        <form action="" method="post">
        <?php 
        function ageNow($date_string) {
            if (empty($date_string)) {
                return 'invalid input.';
            }
            try {
                $today = new DateTime();
                $dob = new DateTime($date_string);
                if ($today < $dob) {
                    return 'invalid input.';
                }
                $result_numbers = date_diff($dob, $today);
                $years_place = $result_numbers->y;
                $months_place = $result_numbers->m;
                $days_place = $result_numbers->d;
                return 'Your age: '.$years_place.' years, '.$months_place.' months, '.$days_place.' days';
            } catch (Exception $e) {
                return "invalid input.";
            }
        }
        ?>
            <input required type="date" name="dob" id="dob"
            <?php 
            if (isset($_POST['dob'])) {
                echo ' value="'.$_POST['dob'].'"';
            }
            ?>
            >
            <label for="dob">Date of Birth</label><br>

            <?php 
            if (isset($_POST['dob'])) {
                echo '<p>'.ageNow($_POST['dob']).'</p>';
            }
            ?>

            <input type="submit" value="Calculate">
        </form>
    </main>
</body>
</html>