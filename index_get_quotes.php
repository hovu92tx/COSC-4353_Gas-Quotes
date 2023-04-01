<?php
require 'connect.php';
try {
    $sql = "SELECT * FROM products";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $product_name = $result['product_name'];
            $product_price = $result['product_price'];
            $product_id = $result['product_id'];
            $html = '<div id="quote_form_container"><form id="quote_form" action="" method="POST">
                    <h3 id="quote_form_h3">' . $product_name . '</h3>
                    <input id="quote_form_productID_input" type="text" readonly value="' . $product_id . '"><br>
                    <label id="quote_form_label" for="product_price">Price:</label>
                    <input id="quote_form_productPrice_input" type="text" readonly value="' . number_format($product_price, 2) . '">
                    <p id="quote_form_unit">$/gallon</p><br>
                    <p id="quote_form_text">(Tax is included.)</p>
                </form></div>';
            echo $html;
        }
    }
} catch (PDOException $error) {
    echo "Server Error";
}
