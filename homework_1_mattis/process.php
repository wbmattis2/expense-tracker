<?php
    //TECH282 Homework 1
    //By Benny Mattis

    //collect form data from previous page
    $name = $_POST['name'];
    $email = $_POST['email'];
    $package = $_POST['package'];
    $date = $_POST['date'];
    $number_persons = $_POST['number_persons'];
    $boarding = $_POST['boarding'];
    $fooding = $_POST['fooding'];
    $sight_seeing = $_POST['sight_seeing'];
    $discount_code = $_POST['discount_code'];
    $terms_conditions = $_POST['terms_conditions'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Complete</title>
    <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
</head>
<body>
<?php include("./assets/php/_nav.php"); ?>
    <header>
        <h1>Your reservation form has been submitted!</h1>
    </header>
    <main>
        <label>Full name:</label>
        <?php echo $name; ?><br>

        <label>Email address:</label>
        <?php echo $email; ?><br>

        <label>Tour Package:</label>
        <?php echo $package; ?><br>

        <label>Arrival date:</label>
        <?php echo $date; ?><br>

        <label>Number of persons:</label>
        <?php echo $number_persons; ?><br>

        <label>Optional features (selected features are marked "on"; remaining features can be added at any time!):</label><br>
        <div class="indent">
            <label>Boarding:</label>
            <?php echo $boarding; ?><br>

            <label>Fooding:</label>
            <?php echo $fooding; ?><br>

            <label>Sight seeing:</label>
            <?php echo $sight_seeing; ?><br>
        </div>

        <label>Discount Coupon code:</label>
        <?php echo $discount_code; ?><br>

        <label>Terms and conditions response:</label>
        <?php echo $terms_conditions; ?><br>
    </main>
</body>
</html>