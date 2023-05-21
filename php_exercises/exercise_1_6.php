<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 1.6: Phone Number Validator</h2>
        <p>
            Takes a given phone number entered by the user and formats it into ten digits according to the North American Numbering Plan (NANP).
            Displays "Invalid Entry" if user input can not be formatted into a NANP number.
            This validator only works for phone numbers with an international country code of 1.
        </p>
        <form action="" method="post">
        <?php
            function validate($number_to_validate) {
                $error_notice = "Invalid Entry";
                $x_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                $n_digits = array('0', '1');
                $result = "";
                $result_index = 0;
                $length = strlen($number_to_validate);
                for ($i = 0; $i < $length; $i++) {
                    $potential_digit = $number_to_validate[$i];
                    if ( $result_index == 0 && $potential_digit == '1' ) {
                        continue;
                    }
                    else if ( $result_index == 3 && in_array($potential_digit, $n_digits) ) {
                        return $error_notice;
                    }
                    else if ( in_array($potential_digit, $x_digits ) ) {
                        $result .= $potential_digit;
                        $result_index++;
                    }
                }
                if ( strlen($result) != 10 ) {
                    return $error_notice;
                }
                return $result;
            }
        ?>
            <input type="text" name="number_to_validate" id="number_to_validate"
            <?php 
            if (isset($_POST['number_to_validate'])) {
                echo ' value="'.$_POST['number_to_validate'].'"';
            }
            ?>
            >
            <label for="number_to_validate">Number to validate</label><br>

            <input name="validated_number" id="validated_number"
            <?php 
            if (isset($_POST['number_to_validate'])) {
                echo ' value="'.validate($_POST['number_to_validate']).'"';
            }
            ?>
            >
            <label for="validated_number">Validated number</label><br>

            <input type="submit" value="Validate">
        </form>
    </main>
</body>
</html>