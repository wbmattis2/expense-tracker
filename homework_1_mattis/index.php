<!--
    TECH282 Homework 1
    by Benny Mattis
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Reservation Form</title>
    <link rel="stylesheet" href="./assets/css/styles.css" type="text/css">
</head>
<body>
<?php include("./assets/php/_nav.php"); ?>
    <header>
        <h1>HW 1 Exercise 1: Travel reservation form</h1>
        <span class="tagline">* denotes mandatory</span>
    </header>
    <main>
        <form action="process.php" method="post">
            <label>Full name*:</label><br>
            <input type="text" name="name" required><br>

            <label>Email address*:</label><br>
            <input type="email" name="email" required><br>

            <label>Select Tour Package*:</label><br>
            <select name="package" required>
                <option value="Goa">Goa</option>
                <option value="Helsinki">Helsinki</option>
                <option value="Washington, DC">Washington, DC</option>
            </select><br>

            <label>Arrival date*:</label><br>
            <input type="date" name="date" required><br>

            <label>Number of persons*:</label><br>
            <input type="number" name="number_persons" value="1" required><br>

            <label>What would you want to avail?*:</label><br>
            <div class="indent">
                <label>Boarding</label>
                <input type="checkbox" name="boarding"><br>

                <label>Fooding</label>
                <input type="checkbox" name="fooding"><br>

                <label>Sight seeing</label>
                <input type="checkbox" name="sight_seeing"><br>
            </div>
            <label>Discount Coupon code:</label><br>
            <input type="text" name="discount_code"><br>

            <label>Terms and conditions*</label><br>
            <input type="radio" name="terms_conditions" value="Agree" required>
            <label>I agree</label>

            <input type="radio" name="terms_conditions" value="Disagree" required>
            <label>I disagree</label><br>

            <input type="submit" name="btn-submit" value="Complete reservation">

        </form>
    </main>
</body>
</html>