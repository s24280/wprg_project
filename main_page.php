<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
require_once('functions.php');

if (isset($_POST['addButton'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $product_id = $_POST['product_id'];
    $product_info = getProductInfo($product_id);

    if ($product_info !== null) {
        $product_array = array(
            'product_id' => $product_id,
            'product_name' => $product_info['product_name'],
            'product_price' => $product_info['product_price']
        );

        $_SESSION['cart'][] = $product_array;

        print_r($_SESSION['cart']);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">

    <title>Main Page</title>

    <link rel="stylesheet" href="stylesheet.css">

</head>
<body class="body">
<div class="navbar">
<ul>
    <li><a href="account_info.php">Account</a></li>
    <li><a href="cart.php">Cart</a></li>
</ul>
</div>
    <div>
        <?php
        $result = getData();
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach ($rows as $row) {
            DisplayProduct($row['product_id'], $row['product_name'], $row['product_price'], $row['product_desc'], $row['product_image']);
        }
        ?>
    </div>
</body>
</html>
