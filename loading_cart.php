<?php
require 'connect.php';
if (empty($_SESSION['cart'])) {
    $html = '<div style="text-align: center;"><p>Cart is empty</p></div><a id="button_link" href="dashboard.php">Start Shopping</a>';
    echo $html;
} else {
    /**List all items in the cart to screen */
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
                                        <th id="quantity"><input id="quantity_input" name="quantity" type="number" value="' . $quantity . '" min= "1"></input><button id="form_button" type="submit" name="update">Update</button></th>
                                        <th id="total">$' . number_format($total, 2) . '</th>
                                        <th><button id="form_button" type="submit" name="remove">Remove</button></th>
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
    echo '<div id="order_total"><h2>Order Total: $' . number_format($_SESSION['order_total'], 2) . ' </h2></div>
                    <div><a id="button_link" href="clear_cart.php">Clear Cart</a><a id="button_link" href="dashboard.php">Continue Shopping</a><a id="button_link" href="shipping_infor.php">Continue</a></div>
                  ';
}
