<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 1: PHP - Simple Calculator Program</h2>
        <p>
            A simple calculator than uses PHP add, subtract, multiply or divide two numbers entered by the user and displays the result.
            Displays "INF" if the result is infinity; displays "NAN" if the program cannot calculate a numerical result.
        </p>
        <form action="" method="post">
            <?php
            $first_number = isset($_POST['first_number']) ? $_POST['first_number'] : 0;
            $second_number = isset($_POST['second_number']) ? $_POST['second_number'] : 0;
            $operator = isset($_POST['operator']) ? $_POST['operator'] : "none";
          5  ?>
            <input name="first_number" id="first_number"
            <?php 
            if ($first_number) {
                echo ' value="'.$first_number.'"';
            }
            ?>
            >
            <label for="first_number">First Number</label><br>

            <input name="second_number" id="second_number"
            <?php 
            if ($second_number) {
                echo ' value="'.$second_number.'"';
            }
            ?>
            >
            <label for="second_number">Second Number</label><br>

            <input id="result" value=
            <?php
            if (!is_numeric($first_number) || !is_numeric($second_number)) {
                echo "NAN";
            }
            else {
                switch($operator) {
                    case "add":
                        echo ( $first_number + $second_number );
                        break;
                    case "subtract":
                        echo ( $first_number - $second_number );
                        break;
                    case "multiply":
                        echo ( $first_number * $second_number );
                        break;
                    case "divide":
                        echo ( $first_number / $second_number );
                        break;
                    default:
                        echo "";
                }
            }
            ?>
            >
            <label for="result">Result</label><br>

            <input type="submit" name="operator" value="add">
            <input type="submit" name="operator" value="subtract">
            <input type="submit" name="operator" value="multiply">
            <input type="submit" name="operator" value="divide">
        </form>
    </main>