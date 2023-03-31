<?php
session_start();
require 'connect.php';
error_reporting(0);
$order_total = 0;
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
    <script src="confirm.js"></script>
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
                    </label><?php echo $_SESSION['cus_name'] ?></h3>
                </div>
                <div class="vertical-menu">
                    <a href="dashboard.php">Home</a>
                    <a href="cart.php" class="active">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                    <a href="orders.php">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a onclick="showConfirm()">Log Out</a>
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
                                    $order_total += $total;
                                    $html = '<form id="item" action="cart_function.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="item_id"><input id="infor" name="product_id" type="text" value="' . $product_id . '" readonly="readonly"></input></th>
                                        <th id="name">' . $product_name . '</th>
                                        <th id="price">$' . $product_price . '</th>
                                        <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $quantity . '" min= "1"></input><button type="submit" name="update">Update</button></th>
                                        <th id="total">$' . number_format($total, 2) . '</th>
                                        <th><button type="submit" name="remove">Remove</button></th>
                                    </tr>
                                </table></form>';
                                    echo $html;
                                }
                            }
                        } catch (PDOException $error) {
                            echo 'Connection fail!';
                        }
                    }
                    $_SESSION['order_total'] = $order_total;
                    echo '<div id="order_total"><h2>Order Total: $' . $_SESSION['order_total'] . ' </h2></div><ul>
                    <li><a href="shipping_infor.php">Continue</a></li>
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