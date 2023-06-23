<?php

include 'functions.php';

if (isset($_POST['login']) && isset($_POST['password'])) {
    $givenLogin = $_POST['login'];
    $givenPassword = $_POST['password'];
    $givenConfirmedPassword = $_POST['password_Confirmed'];
    $address = $_POST['address'];


    $row = mysqli_fetch_assoc(DbQuery("SELECT login FROM users WHERE login = '$givenLogin'"));

    if ($givenLogin == $row['login']) {
        echo "<h3>Login is already used, try again!!</h3>";
        if ($givenPassword != $givenConfirmedPassword) {
            echo "Passwords aren't the same";
        }
    } else {
        DbQuery("INSERT INTO users(login, password, address) VALUES ('$givenLogin','$givenPassword','$address')");
        header("Location: login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shop Pracz</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body class="body">
<FORM action="register_page.php" method="POST">
    <h1>Shop Pracz</h1>
    <h2>Registration page</h2>
    <table>
        <TR>
            <TD>
                <input class="input100" type="text" name="login" placeholder="Login" required>
            </TD>
        </TR>

        <TR>
            <TD>
                <input class="input100" type="password" name="password" placeholder="Password" required>
            </TD>
        </TR>
        <TR>
            <TD>
                <input class="input100" type="password" name="password_Confirmed" placeholder="Confirm password" required>
            </TD>
        </TR>
        <TR>
            <TD>
                <input class="input100" type="text" name="address" placeholder="Address (not e-mail)" required>
            </TD>
        </TR>
        <TR>
            <TD>
                <button class="button_register_registerSite" type="submit" name="sign_up_button">Sign up</button>
            </TD>
        </TR>
        <TR>
            <TD>
                <button onclick="window.location.href = 'login.php'" class="button_register_registerSite" type="submit" name="back_to_sign_in_button" >Back to Log in</button>
            </TD>
        </TR>
    </table>
</FORM>
</body>
</html>