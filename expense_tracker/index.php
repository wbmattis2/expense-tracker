<?php 
session_start();
$logout = filter_input(INPUT_GET, "logout");
if ( isset($logout) && $logout === "logout") {
    if (isset($_COOKIE['username_cookie'])) {
        setcookie('username_cookie', "", time() - 120);
    }
    session_unset();
    session_destroy();
    header("Location:index.php?loggedout=loggedout");
}
include("./assets/php/_db_config.php");
include("./assets/php/_db_toolkit.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include("./assets/php/_head.php"); ?>
<body>
    <?php include("./assets/php/_header.php"); ?>
    <main>
        <section id="login">
            <?php include("./assets/php/_login.php"); ?>
        </section>
        <section id="features">
            <?php
            if (isset($_SESSION['username'])) {
                include("./assets/php/_features.php");
            }
            else {
                echo "<p><q>Not everything that can be counted counts, and not everything that counts can be counted.</q> -Albert Einstein</p>";
            }
            ?>
        </section>
    </main>
</body>
</html>