<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 2: PHP - Voting Eligibility Check</h2>
        <p>
            Determines and displays whether a given age (entered by the user) is old enough to vote in the United States (i.e., whether they are 18 years or older).
        </p>
        <form action="" method="post">
            <?php
                function isEligible($age) {
                    if ($age >= 18) {
                        return "Eligible";
                    }
                    else {
                        return "Not Eligible";
                    }
                }
            ?>
            <input type="number" min="0" name="age" id="age"
            <?php 
            if (isset($_POST['age'])) {
                echo ' value="'.$_POST['age'].'"';
            }
            ?>
            >
            <label for="age">Age</label><br>

            <input name="eligibility" id="eligibility"
            <?php
                if (isset($_POST['age'])) {
                    echo ' value="'.isEligible($_POST['age']).'"';
                }
            ?>
            >
            <label for="eligibility">Eligibility</label><br>

            <input type="submit" value="Determine eligibility">
        </form>
    </main>
</body>
</html>