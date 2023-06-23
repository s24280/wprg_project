<?php
function DbQuery($query)
{
    $dbConnect = mysqli_connect("127.0.0.1", "root", "ZAQ!2wsx", "phpproject");
    $result = mysqli_query($dbConnect, $query);
    mysqli_close($dbConnect);
    return $result;
}
function calculateTotal() {
    $total = 0;

    foreach ($_SESSION['cart'] as $product) {
        $total += $product['product_price'];
    }

    return $total;
}
function getUserInfo($login) {
    // Połączenie z bazą danych
    $conn = mysqli_connect("127.0.0.1", "root", "ZAQ!2wsx", "phpproject");

    // Sprawdzenie połączenia
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM users WHERE login = '$login'";

    // Wykonanie zapytania
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $userInfo = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $userInfo;
    } else {
        mysqli_free_result($result);
        mysqli_close($conn);
        return null;
    }
}

function getProductInfo($product_id) {
    $conn = mysqli_connect("127.0.0.1", "root", "ZAQ!2wsx", "phpproject");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM products WHERE product_id = '$product_id'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product_info = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $product_info;
    } else {
        mysqli_free_result($result);
        mysqli_close($conn);
        return null;
    }
}
function DisplayProduct($product_id, $product_name, $product_price, $product_desc, $product_image)
{
    $product = "
    <div class=\"col-md-3 col-sm-4 my-3 my-md-0\">
                <form action=\"main_page.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$product_image\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$product_name</h5>
                            <p class=\"card-text\">$product_desc</p>
                            <h5>  
                                <span class=\"price\">$$product_price</span>
                            </h5>

                            <button type=\"submit\" name=\"addButton\">Add to cart</button>
                            <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                        </div>
                    </div>
                </form>
            </div>
            ";
    echo $product;
}
function getData()
{
    $sql = "SELECT * FROM products";
    return DbQuery($sql);
}
function saveOrder($login, $totalAmount)
{

    $conn = mysqli_connect("127.0.0.1", "root", "ZAQ!2wsx", "phpproject");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "INSERT INTO orders (user_login, total_amount, order_time)
              VALUES ('$login', '$totalAmount', NOW())";

    if (mysqli_query($conn, $query)) {
        mysqli_close($conn);
        return true;
    } else {
        mysqli_close($conn);
        return false;
    }
}