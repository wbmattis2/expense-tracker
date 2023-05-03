<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Exercise 2: PHP - Rectangle Area Calculator</h2>
        <p>
            Determines and displays the area of a rectangle with width and height provided by user input.
            Displays "invalid input" if two numeric dimensions are not provided.
        </p>
        <form action="" method="post">
            <?php
            function rectArea($width, $height) {
                if ( !is_numeric($width) || !is_numeric($height) ) {
                    return 'invalid input';
                }
                return 'Rectangle Area: '.($width * $height);
                
            }
            ?>
            <input required name="width" id="width"
            <?php 
            if (isset($_POST['width'])) {
                echo ' value="'.$_POST['width'].'"';
            }
            ?>
            >
            <label for="width">Width</label><br>

            <input required name="height" id="height"
            <?php
                if (isset($_POST['height'])) {
                    echo ' value="'.$_POST['height'].'"';
                }
            ?>
            >
            <label for="height">Height</label><br>

            <p>
            <?php
                if (isset($_POST['height']) || isset($_POST['width'])) {
                    echo rectArea($_POST['height'], $_POST['width']);
                }
            ?>
            </p>

            <input type="submit" value="Calculate area">
        </form>
    </main>
</body>
</html>