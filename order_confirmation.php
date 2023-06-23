<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

require_once('functions.php');
$login = $_SESSION['user']['login'];
$userInfo = getUserInfo($login);

$orderTotal = calculateTotal();
$timestamp = date('Y-m-d H:i:s');
$orderId = saveOrder($login, $orderTotal, $timestamp, $_SESSION['cart']);

$_SESSION['cart'] = array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<div class="navbar">
<ul>
    <li><a href="main_page.php">Home</a></li>
    <li><a href="account_info.php">Account</a></li>
    <li><a href="cart.php">Cart</a></li>
</ul>
</div>
<div class="container">
    <h2>Order Confirmation</h2>

    <p>Thank you, <?php echo $userInfo['login']; ?>, for your order!</p>

    <p>Order ID: <?php echo $orderId; ?></p>
    <p>Total Amount: $<?php echo $orderTotal; ?></p>
    <p>Order Time: <?php echo $timestamp; ?></p>

    <p>We will process your order shortly. You will receive an email confirmation with the order details.</p>
</div>
</body>
</html>