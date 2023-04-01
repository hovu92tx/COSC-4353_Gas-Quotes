<?php
require 'connect.php';
try {
    $sql2 = "SELECT * FROM products";
    $statement2 = $conn->query($sql2);
    $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
    if ($results2) {
        foreach ($results2 as $result2) {
            $product_name = $result2['product_name'];
            $product_price = $result2['product_price'];
            $product_id = $result2['product_id'];
            $html = '<div id="quote_form_container">
                    <form id="quote_form" action="cart_function.php" method="POST">
                        <h3 id="quote_form_h3">' . $product_name . '</h3>
                        <input id="quote_form_productID_input" name="product_id" type="text" readonly value="' . $product_id . '"><br>
                        <label id="quote_form_label" for="product_price">Price:</label>
                        <input id="quote_form_productPrice_input" name="product_price" type="text" readonly value="' . $product_price . '">
                        <p id="quote_form_unit">$/gallon</p><br>
                        <p id="quote_form_text">(Tax is included.)</p>
                        <input id="quote_form_quality_input" name="product_quantity" type="number" min="1" value="1">
                        <button id="form_button" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>';
            echo $html;
        }
    }
} catch (PDOException $error) {
    echo 'Connection fail!';
}
