<?php
function load_Cart()
{
    require 'connect.php';
    try {
        if (empty($_SESSION['cart'])) {
            $html = '<h2 style="text-align: center;">Cart</h2>
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
            <div style="text-align: center;"><p>Cart is empty</p></div><a id="button_link" href="dashboard.php">Start Shopping</a>';
            echo $html;
        } else {
            /**List all items in the cart to screen */
            echo '<h2 style="text-align: center;">Cart</h2>
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
                </div>';
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                try {
                    $sql = "SELECT * FROM products WHERE product_id LIKE $product_id";
                    $statement = $conn->query($sql);
                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($results) {
                        foreach ($results as $result) {
                            $product_name = $result['product_name'];
                            $product_price = $result['product_price'];
                            $product_price = price_Calculator($product_price, $quantity);
                            $total = $quantity * $product_price;
                            $order_total += $total;
                            $html = '
                            <div id="list">
                                <form id="item" action="functions.php" method="POST">
                                    <table>
                                        <tr>
                                            <th id="item_id"><input id="infor" name="product_id" type="text" value="' . $product_id . '" readonly="readonly"></input></th>
                                            <th id="name">' . $product_name . '</th>
                                            <th id="price">$' . $product_price . '</th>
                                            <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $quantity . '" min= "1"></input><button id="form_button" type="submit" name="update">Update</button></th>
                                            <th id="total">$' . number_format($total, 2) . '</th>
                                            <th><button id="form_button" type="submit" name="remove">Remove</button></th>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            ';
                            ob_get_clean();
                            echo $html;
                        }
                    }
                } catch (PDOException $error) {
                    echo 'Connection fail!';
                }
            }
            $_SESSION['order_total'] = $order_total;
            echo '<div id="order_total"><h2>Order Total: $' . number_format($_SESSION['order_total'], 2) . ' </h2></div>
                            <div><a id="button_link" href="cart_functions.php?clear_Cart=true">Clear Cart</a><a id="button_link" href="dashboard.php">Continue Shopping</a><a id="button_link" href="shipping_infor.php">Continue</a></div>
                          ';
            ob_get_clean();
        }
    } catch (PDOException $error) {
        echo $error;
    }
}
