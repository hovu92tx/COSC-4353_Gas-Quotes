<?php
session_start();
require 'connect.php';
error_reporting(0);
$order_total = 0;
if (isset($_POST['order_detail'])) {
    $order_id = $_POST['order_id'];
}
try {
    $sql = "SELECT * FROM order_detail WHERE order_id LIKE $order_id";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $delivery_date = $result['order_detail_delivery_date'];
        }
    }
} catch (PDOException $error) {
    echo 'Connection fail!';
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
                <a href="Cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php" class="active">Orders</a>
                <a href="profile.php">Profile</a>
                <a href="logout_action.php">Log Out</a>
            </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Order Detail</h2>
            <div style="width:90%; margin:auto;">
                <h4>Customer name: <?php echo ' ' . $_SESSION['cus_name'] ?></h4>
                <h4>Shipping address:
                    <?php echo ' ' . $_SESSION['cus_add1'] . ', ' . $_SESSION['cus_city'] . ', ' . $_SESSION['cus_state'] . ', ' . $_SESSION['cus_zipcode'] ?>
                </h4>
                <h4>Delivery date:<?php echo ' ' . $delivery_date ?></h4>
            </div>

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
            try {
                $sql2 = "SELECT * FROM order_detail WHERE order_id LIKE $order_id";
                $statement2 = $conn->query($sql2);
                $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                if ($results2) {
                    foreach ($results2 as $result2) {
                        $product_id = $result2['product_id'];
                        $sql3 = "SELECT * FROM products WHERE product_id LIKE $product_id";
                        $statement3 = $conn->query($sql3);
                        $results3 = $statement3->fetchAll(PDO::FETCH_ASSOC);
                        if ($results3) {
                            foreach ($results3 as $result3) {
                                $html = '<form id="item" action="cart_function.php" method="POST"><table>
                                    <tr>
                                        <th id="item_id"><input id="infor" name="product_id" type="text" value="' . $result2['product_id'] . ' "readonly="readonly"></input></th>
                                        <th id="name">' . $result3['product_name'] . '</th>
                                        <th id="price">$' . $result2['order_detail_unit_price'] . '</th>
                                        <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $result2['order_detail_quantity'] . '"readonly="readonly" ></input></th>
                                        <th id="total">$' . $result2['order_detail_total'] . '</th>
                                        <th></th>
                                    </tr>
                                </table></form>';
                            }
                        }
                        $order_total += $result2['order_detail_total'];
                        echo $html;
                    }
                }
            } catch (PDOException $error) {
                echo 'Connection fail!';
            }
            echo '<div id="order_total"><h2>Order Total: $' . number_format($order_total, 2) . ' </h2></div>';
            ?>
            <div style="width:90%; margin: auto;">
                <ul>
                    <li><a href="dashboard.php">Exit</a></li>
                    <li><a href="orders.php">Back</a></li>

                </ul>
            </div>
        </div>


    </section>
</body>
<footer>
</footer>

</html>