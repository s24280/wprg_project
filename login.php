<?php

require_once('functions.php');

if (isset($_POST['login']) && isset($_POST['password'])) {
    $givenLogin = $_POST['login'];
    $givenPassword = $_POST['password'];

    $row = mysqli_fetch_assoc(DbQuery("SELECT login, password FROM users WHERE login = '$givenLogin' AND password = '$givenPassword'"));

    if ($givenLogin == $row['login'] && $givenPassword == $row['password']) {
        session_start();
        $_SESSION['user'] = array(
            'login' => $givenLogin,
            'password' => $givenPassword
        );
        header("Location: main_page.php");
    } else {
        echo "<h3 style='color:red'>Incorrect login or password.</h3>";
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

<FORM action="login.php" method="POST" >
    <h1 align="center">Shop Pracz</h1>
    <h2>Logging page</h2>
    <table>
        <TR>
            <TD>
                <input class="input100" type="text" name="login" placeholder="Login" required> <br>
            </TD>
        </TR>

        <TR>
            <TD>
                <input class="input100" type="password" name="password" placeholder="Password" required> <br>
            </TD>
        </TR>

        <TR>
            <TD>
                <button class="button_register_loginSite" type="submit" name="log_in_button">Log in</button>
            </TD>
        </TR>
        <TR>
            <TD>
        <button onclick="window.location.href = 'register_page.php'" class="button_register_loginSite" type="submit" name="register_button">Sign up</button>
            </TD>
        </TR>
    </table>

</FORM>
<FORM action="register_page.php" method="POST" >
    <table>
        <TR>
            <TD>

            </TD>
        </TR>
    </table>
</FORM>
</body>
</html>