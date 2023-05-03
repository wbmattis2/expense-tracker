<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 7: PHP - PIN Validator</h2>
        <p>
            Checks whether a given PIN consists of exactly 4 or exactly 6 numeric digits.
            Returns TRUE if the PIN validates successfully; returns FALSE otherwise.
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $str = filter_input(INPUT_POST, "pin");

                function validatePIN($str) {
                    $regex_4digit = "/^\d{4}$/";
                    $regex_6digit = "/^\d{6}$/";
                    $boolean_result = preg_match($regex_4digit, $str) || preg_match($regex_6digit, $str);
                    return $boolean_result;
                }
                ?>
                <input required name="pin" id="pin" value="<?=$str?>">
                <label for="pin">PIN to Validate</label><br>

                <p>
                    <?php
                    if (isset($str)) {
                        $result = validatePIN($str) ? "TRUE" : "FALSE";
                        echo "Validation Result: " . $result;
                    }
                    ?>
                </p>

                <input type="submit" value="Validate PIN">
            </form>
        </div>
    </main>
</body>
</html>