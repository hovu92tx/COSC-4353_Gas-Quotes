<?php
session_start();
require 'connect.php';
$name = "#";
try {
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM user_profiles WHERE userid LIKE '$userid'";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $name = $result['name'];
            $address = $result['address1'];
            $city = $result['city'];
            $state = $result['state'];
            $zipcode = $result['zipcode'];
        }
    }
} catch (PDOException $error) {
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>ABC Company</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="CSS/cart.css">
    <script src="clock.js"></script>
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <section id="section1">
        <div id="left_box">
            <form style="text-align: left;" action="logout_action.php" method="POST">
                <div style="text-align:center; padding: 5px;"><label for=" name">
                        <h3><b>Welcome:</b>
                    </label><?php echo $name ?></h3>
                </div>
                <div class="vertical-menu">
                    <a href="dashboard.php">Home</a>
                    <a href="cart.php" class="active">Cart</a>
                    <a href="orders.php">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a href="logout_action.php">Log Out</a>
                </div>
        </div>
        </form>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Cart</h2>
            <div>
                <table>
                    <tr>
                        <th id="item_id">Product ID</th>
                        <th id="name">Product Name</th>
                        <th id="price">Price/Gallon</th>
                        <th id="quantity">Gallon</th>
                        <th id="total">Total</th>
                        <th>Actions</th>
                    </tr>
                </table>
            </div>
            <div id="list">
                <?php
                $_SESSION['order_total'] = 0;

                if (empty($_SESSION['cart'])) {
                    $html = '<div style="text-align: center"><p>Cart is empty</p></div><ul><li><a href="dashboard.php">Start Shopping</a></li></ul>';
                    echo $html;
                } else {

                    foreach ($_SESSION['cart'] as $product_id => $quantity) {
                        try {
                            $sql2 = "SELECT * FROM products WHERE product_id LIKE $product_id";
                            $statement2 = $conn->query($sql2);
                            $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                            if ($results2) {
                                foreach ($results2 as $result2) {
                                    $product_name = $result2['product_name'];
                                    $product_price = $result2['product_price'];
                                    $total = $quantity * $product_price;
                                    $_SESSION['order_total'] += $total;
                                    $order_total = $_SESSION['order_total'];
                                    $html = '<form id="item" action="cart_function.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="item_id"><input id="infor" name="product_id" type="text" value="' . $product_id . '" readonly="readonly"></input></th>
                                        <th id="name">' . $product_name . '</th>
                                        <th id="price">$' . $product_price . '</th>
                                        <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $quantity . '" ></input><button type="submit" name="update">Update</button></th>
                                        <th id="total">$' . $total . '</th>
                                        <th><button type="submit" name="remove">Remove</button></th>
                                    </tr>
                                </table>';
                                    echo $html;
                                }
                            }
                        } catch (PDOException $error) {
                            echo 'Connection fail!';
                        }
                    }
                    echo '<div id="order_total"><h2>Order Total: $' . $order_total . ' </h2></div><ul>
                    <li><a href="shipping_infor.php">Place Order</a></li>
                    <li><a href="dashboard.php">Continue Shopping</a></li>
                    <li><a href="clear_cart.php">Clear Cart</a></li>
                  </ul>';
                }
                ?>
            </div>

        </div>
    </section>
</body>
<footer>
</footer>

</html>