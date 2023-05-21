<?php
//First, check if user is already logged in with a cookie
if (isset($_COOKIE['username_cookie'])) {
    $_SESSION['username'] = $_COOKIE['username_cookie'];
} 
//If they are not logged in with a cookie, check whether session should be updated with new login information
else {
    $login_username = filter_input(INPUT_POST, "login_username");
    $login_pwd = filter_input(INPUT_POST, "login_pwd");
    $use_cookies = filter_input(INPUT_POST, "use_cookies");
    $new_user = filter_input(INPUT_GET, "new_user");
    $user_add_var = filter_input(INPUT_GET, "user_add");
    $user_add_messages = array(
        "success" => '<p class="success-notice">You have created an account with the username <span>' . htmlentities($new_user) . '</span>. Please re-enter your password to log in.</p>',
        "failure" => '<p class="failure-notice">Failed to create new account with the username <span>' . htmlentities($new_user) . '</span>. Please try again with a different username.</p>'
    );

    function validate_login($username, $pwd) { 
    //Returns TRUE for successful login, or FALSE for unsuccessful logins.
    //If the username does not already exist, creates a new record and feeds notice to user through POST-REDIRECT-GET
        global $conn;
        $query = "SELECT * FROM registered_users WHERE username = '".mysqli_real_escape_string($conn, $username)."'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO registered_users (`username`, `password`) VALUES ('".mysqli_real_escape_string($conn, $username)."', '".mysqli_real_escape_string($conn, $pwd)."')";
            $result = mysqli_query($conn, $query);
            $user_add = $result ? "success" : "failure";
            header("Location:index.php?user_add=$user_add&new_user=$username");
            exit("Redirecting...");
        }
        $query = "SELECT * FROM registered_users WHERE username = '".mysqli_real_escape_string($conn, $username)."' AND `password` = '".mysqli_real_escape_string($conn, $pwd)."'";
        $result = mysqli_query($conn, $query);
        return (mysqli_num_rows($result) == 1);
    }

    if ( isset($login_username) && !empty($login_pwd) ) {
        $encrypted_pwd = md5($login_pwd);
        if ( validate_login($login_username, $encrypted_pwd) ) {
            $_SESSION['username'] = $login_username;
			$_SESSION['filename'] = id_from_name("user_id", $_SESSION['username'], TRUE) . "-" . md5(md5($login_username) . random_int(0,100) . md5($login_pwd));
            if ($use_cookies['yes']) {
                setcookie("username_cookie", $login_username, time() + 60 * 60 * 24);
            }
        } 
        else {
            echo '<p class="failure-notice">Login failed for username <span>' . $login_username . '</span>.</p>';
        }
    }
}
//notify user of current login status
if (isset($_SESSION['username'])) {
    echo '<p>You are logged in as <span>' . $_SESSION['username'] . '</span>. <a href="index.php?logout=logout">Logout</a></p>';
} 
else { 
    if (isset($new_user)) { //Use query string from POST-REDIRECT-GET to explain whether new account was successfully created
        echo $user_add_messages[$user_add_var];
    }
    else {
		$loggedout = filter_input(INPUT_GET, "loggedout");
		if ($loggedout) {
			echo '<p class="success-notice">You have successfully logged out of your account.</p>';
		}
        echo '<p>Please log in below, or enter new credentials to create an account.</p>';
    }
?>
    <form action="" method="POST">
        <label for="login_username">Username: </label>
        <input required name="login_username" id="login_username" maxlength="15" value="<?=$new_user?>">
        <br>
        <label for="login_pwd">Password: </label>
        <input required type="password" name="login_pwd" id="login_pwd" maxlength="15">
        <br>
        <label for="use_cookies">Remember me with a 24-hour cookie (optional): </label>
        <input type="checkbox" name="use_cookies" value="yes" id="use_cookies">
        <br>
        <button type="submit">Log in</button>
    </form>
<?php } //Form is only displayed if session username is not set (i.e., if user is not logged in)
?>