<?php
session_start();

require_once('functions.php');


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

if (isset($_POST['place_order'])) {
    $orderID = saveOrder($_SESSION['user']['login'], calculateTotal());

    header("Location: order_confirmation.php?order_ID=$orderID");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body class="body">
<div class="navbar">
<ul>
    <li><a href="main_page.php">Home</a></li>
    <li><a href="account_info.php">Account</a></li>
    <li><a href="cart.php">Cart</a></li>
</ul>
</div>
<div class="container">
    <h2>Checkout</h2>

    <h3>Order Summary</h3>
    <table>
        <thead>
        <tr>
            <th style="color:red">Product Name</th>
            <th style="color:red">Price</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $product) : ?>
            <tr>
                <td style="color:green"><?php echo $product['product_name']; ?></td>
                <td style="color:green"><?php echo $product['product_price']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total: <?php echo calculateTotal(); ?></h3>

    <form action="checkout.php" method="post">
        <button type="submit" name="place_order">Place Order</button>
    </form>
</div>
</body>
</html>