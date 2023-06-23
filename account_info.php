<?php
session_start();
require_once('functions.php');

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userInfo = getUserInfo($_SESSION['user']['login']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Information</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<div class="navbar">
<ul>
    <li><a href="main_page.php">Home</a></li>
    <li><a class="active" href="account_info.php">Account</a></li>
    <li><a href="cart.php">Cart</a></li>
</ul>
</div>
<div class="container">
    <?php if ($userInfo !== null) : ?>
        <h3>Login: <?php echo $userInfo['login']; ?></h3>
        <h3>Address: <?php echo $userInfo['address']; ?></h3>
        <h3>Create Time: <?php echo $userInfo['create_time']; ?></h3>
    <?php else : ?>
        <p>No user information available.</p>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</div>
</body>
</html>