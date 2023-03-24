<?php
session_start();
require 'connect.php';
error_reporting(0);
if (isset($_POST['place_order_button'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $_SESSION['delivery_date'] = $_POST['date'];
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
    <link rel="stylesheet" href="CSS/order_review.css">
    <script src="clock.js"></script>
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <section id="section1">
        <div id="left_box">
            <div style="text-align:center; padding: 5px;"><label for=" name">
                    <h3><b>Welcome:</b>
                </label><?php echo $name ?></h3>
            </div>
            <div class="vertical-menu">
                <a href="dashboard.php">Home</a>
                <a href="Cart.php" class="active">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php">Orders</a>
                <a href="profile.php">Profile</a>
                <a href="logout_action.php">Log Out</a>
            </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Order Review</h2>
            <div style="width:90%; margin:auto;">
                <h4>Customer name: <?php echo ' ' . $name ?></h4>
                <h4>Shipping address:
                    <?php echo ' ' . $address . ', ' . $city . ', ' . $state . ', ' . $zipcode ?>
                </h4>
                <h4>Delivery date:<?php echo ' ' . $_SESSION['delivery_date'] ?></h4>
            </div>
            <h3>Order Detail:</h3>
            <div>
                <table>
                    <tr>
                        <th id="item_id">Product ID</th>
                        <th id="name">Product Name</th>
                        <th id="price">Price/Gallon</th>
                        <th id="quantity">Gallon</th>
                        <th id="total">Total</th>
                        <th>Notes</th>
                    </tr>
                </table>
            </div>
            <?php
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
                                $html = '<form id="item" action="cart_function.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="item_id"><input id="infor" name="product_id" type="text" value="' . $product_id . ' "readonly="readonly"></input></th>
                                        <th id="name">' . $product_name . '</th>
                                        <th id="price">$' . $product_price . '</th>
                                        <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $quantity . '"readonly="readonly" ></input></th>
                                        <th id="total">$' . $total . '</th>
                                        <th></th>
                                    </tr>
                                </table></form>';
                                echo $html;
                            }
                        }
                    } catch (PDOException $error) {
                        echo 'Connection fail!';
                    }
                }


                echo '<div id="order_total"><h2>Order Total: $' . $_SESSION['order_total'] . ' </h2></div>';
            }
            ?>
            <div style="width:90%; margin: auto;">
                <ul>
                    <li><a href="place_order.php">Place Order</a></li>
                    <li><a href="cart.php">Modify Order</a></li>
                </ul>
            </div>
        </div>


    </section>
</body>
<footer>
</footer>

</html>