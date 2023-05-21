<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 3.6: Second-Largest Number Finder</h2>
        <p>
            Finds the second largest value within an array of numbers.
            Returns  value and first location of second largest number within said array, or "invalid input" if a second largest number cannot be found.
            User enters the array of names as a comma-separated list.
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $num_list = filter_input(INPUT_POST, "num_list");

                function secondLargest($arr) {
                    $arrLength = count($arr);
                    $largest = NULL;
                    $second_largest = NULL;
                
                    for ($i = 0; $i < $arrLength; $i++) {
                        $element = $arr[$i];
                        if ( is_numeric($element) ) {
                            if ( !isset($largest) || $element > $largest ) {
                                $second_largest = $largest;
                                $largest = floatval($element);
                            }
                            else if ($element > $second_largest) {
                                $second_largest = $element;
                            }
                        }
                    }
                    $second_largest ??= "invalid input";
                    return $second_largest;
                }
                ?>
                <input required name="num_list" id="num_list" value="<?=$num_list?>">
                <label for="num_list">Array of Numbers (enter as a comma-separated list)</label><br>

                <p>
                    <?php
                    if (isset($num_list)) {
                        $arr = explode(",", $num_list);
                        echo secondLargest($arr);
                    }
                    ?>
                </p>

                <input type="submit" value="Find Second-Largest Number">
            </form>
        </div>
    </main>
</body>
</html>