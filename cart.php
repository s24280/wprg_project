<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $product = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price
    );

    $_SESSION['cart'][] = $product;
}

if (isset($_POST['remove_from_cart'])) {
    $product_index = $_POST['product_index'];

    unset($_SESSION['cart'][$product_index]);

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<div class="navbar">
<ul>
    <li><a href="main_page.php">Home</a></li>
    <li><a href="account_info.php">Account</a></li>
    <li><a class="active" href="cart.php">Cart</a></li>
</ul>
</div>
<div class="container">
    <h2>Szopping Cart</h2>

    <?php if ($_SESSION['cart'] == null) : ?>
        <p>Your cart is empty.</p>
    <?php else : ?>
    <table>
        <thead>
        <tr>
            <th style="color:red">Product Name</th>
            <th style="color:red">Price</th>
            <th style="color:red">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $index => $product) : ?>
            <tr>
                <td style="color:green"><?php echo $product['product_name']; ?></td>
                <td style="color:green"><?php echo $product['product_price']; ?></td>
                <td>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="product_index" value="<?php echo $index; ?>">
                        <button type="submit" name="remove_from_cart">Remove</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

        <a href="checkout.php">Proceed to Checkout</a>
    <?php endif; ?>
</div>
</body>
</html>