<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Specifications</title>
    <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
</head>
<body>
<?php include("./assets/php/_header.php"); ?>
    <main>
        <?php
        $raw_specs = file_get_contents('./specifications.txt', 'r');
        echo '<p>' . nl2br(htmlspecialchars($raw_specs)) . '</p>';
        ?>
    </main>
</body>
</html>