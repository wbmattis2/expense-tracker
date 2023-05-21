<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 3.4: Bob Finder</h2>
        <p>
            Assuming all entered names consist in a capital letter followed by lowercase letters, finds "Bob" within an array of names.
            Returns the location of the first appearance of "Bob" within said array, or -1 if "Bob" is not an array element.
            User enters the array of names as a comma-separated list.
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $name_list = filter_input(INPUT_POST, "name_list");

                function findBob($arr) {
                    $arr_length = count($arr);
                    $result = "";
                    for ($i = 0; $i < $arr_length; $i++) {
                        if (trim($arr[$i]) == "Bob") {
                            return $i;
                        }
                    }
                    return -1;
                }
                ?>
                <input required name="name_list" id="name_list" value="<?=$name_list?>">
                <label for="name_list">Array of Names (enter as a comma-separated list)</label><br>

                <p>
                    <?php
                    if (isset($name_list)) {
                        $arr = explode(",", $name_list);
                        echo findBob($arr);
                    }
                    ?>
                </p>

                <input type="submit" value="Find Bob">
            </form>
        </div>
    </main>
</body>
</html>