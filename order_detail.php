<?php
session_start();
require 'connect.php';
include 'config/template.php';
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
    <?php echo $head ?>
</head>

<body>
    <header>
        ABC Company
    </header>
    <aside>
        <?php menu('order') ?>
    </aside>
    <section>
        <h2 style="text-align: center;">Order Detail</h2>
        <div style="text-align: left; width: 90%; margin: auto;">
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
                                        <th id="total">$' . number_format($result2['order_detail_total'], 2) . '</th>
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
        echo '<div>
                <a id="button_link" href="orders.php">Back</a>
                <a id="button_link" href="dashboard.php">Exit</a>
                </div>';
        ?>
    </section>
</body>
<footer>
</footer>

</html>