<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
    <title>
        <?php
        switch(filter_input(INPUT_GET, 'title')) {
            case 1:
                echo "Exercise 1";
                break;
            case 2:
                echo "Exercise 2";
                break;
            case 3:
                echo "Exercise 3";
                break;
            case 4:
                echo "Exercise 4";
                break;
            case 5:
                echo "Exercise 5";
                break;
            case 6:
                echo "Exercise 6";
                break;
            case 7:
                echo "Exercise 7";
                break;
            default:
                echo "Homework 4";
        }
        ?>
    </title>
</head>