<?php
session_start();
require 'connect.php';
include 'config/template.php';
include 'functions.php';
error_reporting(0);
if (isset($_POST['place_order_button'])) {
    $_SESSION['delivery_date'] = $_POST['date'];
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
        <?php menu('cart'); ?>
    </aside>
    <section>
        <h2 style="text-align: center;">Order Review</h2>
        <div style="width:90%; margin:auto; text-align: left;">
            <h4>Customer name: <?php echo ' ' . $_SESSION['cus_name'] ?></h4>
            <h4>Shipping address:
                <?php echo ' ' . $_SESSION['cus_add1'] . ', ' . $_SESSION['cus_city'] . ', ' . $_SESSION['cus_state'] . ', ' . $_SESSION['cus_zipcode'] ?>
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
                            $product_price = price_Calculator($product_price, $quantity);
                            $total = $product_price * $quantity;
                            $html = '<form id="item" action="functions.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="item_id"><input id="infor" name="product_id" type="text" value="' . $product_id . ' "readonly="readonly"></input></th>
                                        <th id="name">' . $product_name . '</th>
                                        <th id="price">$' . $product_price . '</th>
                                        <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $quantity . '"readonly="readonly" ></input></th>
                                        <th id="total">$' . number_format($total, 2) . '</th>
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
            echo '<div id="order_total"><h2>Order Total: $' . number_format($_SESSION['order_total'], 2) . ' </h2></div>';
        }
        ?>
        <div style="width:90%; margin: auto;">
            <a id="button_link" href="cart.php">Modify Order</a>
            <a id="button_link" href="functions.php?placeOrder=true">Place Order</a>
        </div>
    </section>
</body>
<footer>
</footer>

</html>