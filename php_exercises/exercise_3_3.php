<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <h2>Demonstration 3.3: Vowel Remover</h2>
        <p>
            Removes all vowels from user input.
        </p>
        <div class="showcase">
            <form action="" method="post">
                <?php
                $word = filter_input(INPUT_POST, "word");
                
                function removeVowels($str) {
                    $regex = "/[aeiou]/i";
                    return "Your Word with Vowels Removed: " . preg_replace($regex, "", $str);
                    
                }
                ?>
                <input required name="word" id="word" value="<?=$word?>">
                <label for="word">Enter Your Word</label><br>

                <p>
                    <?=removeVowels($word)?>
                </p>

                <input type="submit" value="Remove Vowels">
            </form>
        </div>
    </main>
</body>
</html>