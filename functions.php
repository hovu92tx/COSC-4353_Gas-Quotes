<?php
error_reporting(0);
session_start();
//**LOGIN CHECK */
if (isset($_POST["loginButton"])) {
    require 'connect.php';
    include 'config/sessions.php';
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $uname = $_POST['username'];
        $pass = $_POST['password'];
        if (pass_Check($pass) && userName_Check($uname)) {
            $encrypted_UserName = encrypt_Data($uname);
            $encrypted_Password = encrypt_Data($pass);
            /**Check whether the username exist in the database or not*/
            $sql = "SELECT * FROM users WHERE username LIKE '$encrypted_UserName'";
            $statement = $conn->query($sql);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                foreach ($results as $result) {
                    $username = $result['username'];
                    /** If the usename exist in the database, check password*/
                    $sql2 = "SELECT * FROM users WHERE username LIKE '$encrypted_UserName' and password LIKE '$encrypted_Password'";
                    $statement = $conn->query($sql2);
                    $results2 = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($results2) {
                        foreach ($results2 as $result2) {
                            $user_id = $result2['userid'];
                            /**Check user's information after check username and password */
                            $sql3 = "SELECT * FROM user_profiles WHERE userid LIKE '$user_id'";
                            $statement = $conn->query($sql3);
                            $results3 = $statement->fetchAll(PDO::FETCH_ASSOC);
                            if ($results3) {
                                foreach ($results3 as $result3) {
                                    if ($result3['name'] === '0' | $result3['address1'] === '0' | $result3['city'] === '0' | $result3['state'] === '0' | $result3['zipcode'] === '0') {
                                        $_SESSION['username'] = $result['username'];
                                        $_SESSION['userid'] = $result2['userid'];
                                        /**Ask customer to provide customer's information for the first time login */
                                        header('location: profile_filling_page.php');
                                    } else {
                                        $_SESSION['username'] = $result['username'];
                                        $_SESSION['userid'] = $result2['userid'];
                                        $_SESSION['cus_name'] = $result3['name'];
                                        $_SESSION['cus_add1'] = $result3['address1'];
                                        $_SESSION['cus_add2'] = $result3['address2'];
                                        $_SESSION['cus_city'] = $result3['city'];
                                        $_SESSION['cus_state'] = $result3['state'];
                                        $_SESSION['cus_zipcode'] = $result3['zipcode'];
                                        /**Go to customer dashboard for old customer */
                                        header('location: dashboard.php');
                                    }
                                }
                            }
                        }
                    } else {
                        /**Pop-up message if password is incorrect */
                        echo ("<script LANGUAGE='JavaScript'>alert('Login Fail! Please Login again');window.location.href='http://localhost/COSC-4353_Group-Project-/index.php';</script>");
                    }
                }
            } else {
                /**Create new username, password, and null profile if customer does not exist in the database then ask customer for customer's information */
                $sql4 = "INSERT INTO `users` (`userid`, `username`, `password`) VALUES (NULL, '$encrypted_UserName', '$encrypted_Password')";
                $conn->query($sql4);
                $sql5 = "SELECT * FROM users WHERE username LIKE '$encrypted_UserName'";
                $statement = $conn->query($sql5);
                $results5 = $statement->fetchAll(PDO::FETCH_ASSOC);
                if ($results5) {
                    foreach ($results5 as $result5) {
                        $user_id = $result5['userid'];
                        $sql6 = "INSERT INTO `user_profiles` (`userid`, `name`, `address1`, `address2`, `city`, `state`, `zipcode`) VALUES ('$user_id', '0', '0', '0', '0', '0', '0')";
                        $conn->query($sql6);
                        $_SESSION['username'] = $encrypted_UserName;
                        $_SESSION['userid'] = $user_id;
                        header('location: profile_filling_page.php');
                    }
                }
            }
        } else {
            if (!pass_Check($pass)) {
                echo ("<script LANGUAGE='JavaScript'>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');window.location.href='http://localhost/COSC-4353_Group-Project-/index.php';</script>");
            } elseif (!userName_Check($uname)) {
                echo ("<script LANGUAGE='JavaScript'>alert('Username should be at least 4 characters in length and should not include any special character.');window.location.href='http://localhost/COSC-4353_Group-Project-/index.php';</script>");
            }
        }
    }
}

/**----CART FUNCTIONS---- */

// Check if the user clicked the "Add to Cart" button
if (isset($_POST['add_to_cart'])) {
    // Get the product ID and quantity from the form
    add_item($_POST['product_id'], $_POST['product_quantity']);
    header('location:dashboard.php');
}

// Check if the user clicked the "Remove" button
if (isset($_POST['remove'])) {
    remove_Item($_POST['product_id']);
    header('location:cart.php');
}

//clear cart
if (isset($_GET['clear_Cart'])) {
    clearCart();
    header('location:cart.php');
}

//update cart
if (isset($_POST['update'])) {
    update_item($_POST['product_id'], $_POST['quantity']);
    header('location:cart.php');
}

/**Order's detail */
if (isset($_POST['order_detail'])) {
}

/**Place an order */
if (isset($_GET['placeOrder'])) {
    placeOrder();
    header('location:thank_you.php');
}
//Fill out profile
if (isset($_POST["pf_submit_button"])) {
    filling('filling');
}

//Update profile
if (isset($_POST["pf_save_button"])) {
    filling('profile');
}

/**-----------------------------------------------------------------------
 * LOGIN FUNCTIONS
 * -----------------------------------------------------------------------
 */

/**Password Check */


/**Encrypt data*/
function encrypt_Data($string)
{
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "COSC4353";

    // Use openssl_encrypt() function to encrypt the data
    $encryption = openssl_encrypt(
        $string,
        $ciphering,
        $encryption_key,
        $options,
        $encryption_iv
    );

    // Display the encrypted string
    return $encryption;
}

/**Deencrypt Data */
function deencrypt_Data($encryption)
{
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';

    // Store the decryption key
    $decryption_key = "COSC4353";

    // Use openssl_decrypt() function to decrypt the data
    $decryption = openssl_decrypt(
        $encryption,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    // Display the decrypted string
    return $decryption;
}

/**Profile Filling */

function filling($page)
{
    require 'connect.php';
    if ($page == 'filling') {
        if (!empty($_POST['name'] && $_POST['address1'] && $_POST['city'] && $_POST['state'] && $_POST['zipcode'])) {
            $user_id = $_SESSION['userid'];
            $name = $_POST['name'];
            $address1 = $_POST['address1'];
            if ($_POST['address2'] === '') {
                $address2 = 'N/A';
            } else {
                $address2 = $_POST['address2'];
            }
            $city = $_POST['city'];
            $state = $_POST['state'];
            if (zipcode_check($_POST['zipcode'])) {
                $_SESSION['cus_name'] = $name;
                $_SESSION['cus_add1'] = $address1;
                $_SESSION['cus_add2'] = $address2;
                $_SESSION['cus_city'] = $city;
                $_SESSION['cus_state'] = $state;
                $zipcode = $_POST['zipcode'];
                $_SESSION['mess'] = "Updated";
                $_SESSION['cus_zipcode'] = $zipcode;
                $_SESSION['mess_color'] = "green";
                $sql = "UPDATE `user_profiles` SET name= '$name', address1='$address1', address2= '$address2', city= '$city',state= '$state', zipcode= '$zipcode' WHERE userid ='$user_id'";
                $conn->query($sql);
                header('location: dash_board.php');
            } else {
                $_SESSION['mess'] = "Invalid zipcode";
                $_SESSION['mess_color'] = "red";
                header('location: profile_filling_page.php');
            }
        }
    } elseif ($page == 'profile') {
        if (!empty($_POST['name'] && $_POST['address1'] && $_POST['city'] && $_POST['state'] && $_POST['zipcode'])) {
            $user_id = $_SESSION['userid'];
            $name = $_POST['name'];
            $address1 = $_POST['address1'];
            if ($_POST['address2'] === '') {
                $address2 = 'N/A';
            } else {
                $address2 = $_POST['address2'];
            }
            $city = $_POST['city'];
            $state = $_POST['state'];
            if (zipcode_check($_POST['zipcode'])) {
                $_SESSION['cus_name'] = $name;
                $_SESSION['cus_add1'] = $address1;
                $_SESSION['cus_add2'] = $address2;
                $_SESSION['cus_city'] = $city;
                $_SESSION['cus_state'] = $state;
                $zipcode = $_POST['zipcode'];
                $_SESSION['mess'] = "Updated";
                $_SESSION['cus_zipcode'] = $zipcode;
                $_SESSION['mess_color'] = "green";
                $sql = "UPDATE `user_profiles` SET name= '$name', address1='$address1', address2= '$address2', city= '$city',state= '$state', zipcode= '$zipcode' WHERE userid ='$user_id'";
                $conn->query($sql);
                header('location: profile.php');
            } else {
                $_SESSION['mess'] = "Invalid zipcode";
                $_SESSION['mess_color'] = "red";
                header('location: profile.php');
            }
        }

    }
}

function zipcode_check($zip)
{
    $zip_pattern = '/^[0-9]{5}(?:-[0-9]{4})?$/'; // pattern for US zip code (including 9-digit zip code)
    return preg_match($zip_pattern, $zip);
}

/**-----------------------------------------------------------------------
 * CART'S FUNCTIONS 
 * -----------------------------------------------------------------------
 */



/**add item to cart function */
function add_item($p_id, $p_quantity)
{
    $product_id = $p_id;
    $quantity = $p_quantity;
    // If the product is already in the cart, update the quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
        $_SESSION['mess'] = 'Added to your cart!';
    } else {
        // Otherwise, add the product to the cart
        $_SESSION['cart'][$product_id] = $quantity;
        $_SESSION['mess'] = 'Added to your cart!';
    }
    $_SESSION['numberOfOrder'] = count($_SESSION['cart']);
}

//Update cart function
function update_item($p_id, $p_quantity)
{
    $product_id = $p_id;
    $quantity = $p_quantity;
    $_SESSION['cart'][$product_id] = $quantity;
}

/**Remove Item function */
function remove_Item($p_id)
{
    $product_id = $p_id;
    unset($_SESSION['cart'][$product_id]);
    $_SESSION['numberOfOrder'] = count($_SESSION['cart']);
}

/**Clear cart function */
function clearCart()
{
    unset($_SESSION['cart']);
    $_SESSION['numberOfOrder'] = 0;
}

/**Loading cart and list items on the screen */
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
                            echo $html;
                        }
                    }
                } catch (PDOException $error) {
                    echo 'Connection fail!';
                }
            }
            $_SESSION['order_total'] = $order_total;
            echo '<div id="order_total"><h2>Order Total: $' . number_format($_SESSION['order_total'], 2) . ' </h2></div>
                            <div><a id="button_link" href="functions.php?clear_Cart=true">Clear Cart</a><a id="button_link" href="dashboard.php">Continue Shopping</a><a id="button_link" href="shipping_infor.php">Continue</a></div>
                          ';
        }
    } catch (PDOException $error) {
        echo 'Connection fail!';
    }
}

/**-----------------------------------------------------------------------
 * ORDER'S FUNCTIONS
 * -----------------------------------------------------------------------
 */



/**Order History */
function orders()
{
    require 'connect.php';
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM orders WHERE user_id LIKE $userid";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $result) {
        $order_id = $result['order_id'];
        $order_date = $result['order_date'];
        $order_total = $result['order_total'];
        $html = '<form id="item" action="order_detail.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="order_id"><input id="infor" name="order_id" type="text" value="' . $order_id . ' "readonly="readonly"></input></th>
                                        <th id="date">' . date('m-d-Y', strtotime($order_date)) . '</th>
                                        <th id="add">' . $_SESSION['cus_add1'] . ', ' . $_SESSION['cus_city'] . ', ' . $_SESSION['cus_state'] . ', ' . $_SESSION['cus_zipcode'] . '</th>
                                        <th id="total">$' . number_format($order_total, 2) . '</th>
                                        <th id="action"><button id="form_button" type="submit" name="order_detail">Order Detail</button></th>
                                    </tr>
                                </table></form>';
        echo $html;
    }
}

/**Order's detail */

function order_detail($order_id)
{
}

/**Place an order */
function placeOrder()
{
    require 'connect.php';
    /**write order data into database */
    error_reporting(0);
    try {
        /**Get information of order */
        $userid = $_SESSION['userid'];
        $order_total = $_SESSION['order_total'];
        $date = date("Y-m-d h:i:s");

        /**Insert data into order table */
        $sql = "INSERT INTO orders (user_id,order_total,order_date) VALUES ($userid,$order_total,'$date')";
        $conn->query($sql);

        /**Get current order ID */
        $sql1 = "SELECT order_id FROM orders WHERE order_date='$date'";
        $statement1 = $conn->query($sql1);
        $results1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results1 as $result1) {
            $order_id = $result1['order_id'];
        }

        /**Insert data into order_detail table */
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $sql2 = "SELECT * FROM products WHERE product_id LIKE $product_id";
            $statement2 = $conn->query($sql2);
            $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
            if ($results2) {
                foreach ($results2 as $result2) {
                    $product_name = $result2['product_name'];
                    $product_price = $result2['product_price'];
                    $product_price = price_Calculator($product_price, $quantity);
                    $total = $quantity * $product_price;
                }
            }
            $delivery_date = $_SESSION['delivery_date'];
            $sql3 = "INSERT INTO order_detail (order_id,product_id,order_detail_unit_price, order_detail_quantity,order_detail_total,order_detail_delivery_date) VALUES ($order_id,$product_id,$product_price,$quantity,$total,'$delivery_date')";
            $conn->query($sql3);
        }
    } catch (PDOException $error) {
    }
    unset($_SESSION['cart']);
    $_SESSION['numberOfOrder'] = 0;
}

/**-----------------------------------------------------------------------
 * QUOTE"S FUNCTIONS
 * -----------------------------------------------------------------------
 */

/**Price Calculation */
function location_Factor()
{
    if ($_SESSION['cus_state'] != 'Texas') {
        $location_Factor = 4;
        return $location_Factor;
    } else {
        $location_Factor = 2;
        return $location_Factor;
    }
}
function his_Factor()
{
    require 'connect.php';
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM orders WHERE user_id LIKE $userid";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (empty($results)) {
        $his_factor = 0;
        return $his_factor;
    } else {
        $his_factor = 1;
        return $his_factor;
    }
}
function price_Calculator($current_Price, $quantity)
{
    $lo_Factor = location_Factor();
    $his_rate = his_Factor();
    if ($quantity > 1000) {
        $margin = $current_Price * (($lo_Factor - $his_rate + 2 + 10) / 100);
    } else {
        $margin = $current_Price * (($lo_Factor - $his_rate + 3 + 10) / 100);
    }

    $suggested_Price = $current_Price + $margin;
    number_format($suggested_Price, 2);
    return $suggested_Price;
}

/**get quote for dashboard */
function dash_quote()
{
    require 'connect.php';
    echo '<h2 style="background-color: rgb(91, 253, 91); margin: 0em; padding: 0.5em; text-align: center;">Prices of gas in ' . $_SESSION['cus_city'] . '</h2>
        <div style=" text-align: center; margin: 10px;">
        </div>
        <div style="margin: auto; width: 98%;  background-color: lightgreen; text-align: center;">' . $_SESSION['mess'] .
        $_SESSION['mess'] = "" .
        '</div>';
    try {
        $sql = "SELECT * FROM products";
        $statement = $conn->query($sql);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            foreach ($results as $result) {
                $product_name = $result['product_name'];
                $product_price = $result['product_price'];
                $product_id = $result['product_id'];
                $product_price = price_Calculator($product_price, 100);
                $html = '<div id="quote_form_container">
                    <form id="quote_form" action="functions.php" method="POST">
                        <h3 id="quote_form_h3">' . $product_name . '</h3>
                        <input id="quote_form_productID_input" name="product_id" type="text" readonly value="' . $product_id . '"><br>
                        <label id="quote_form_label" for="product_price">Price:</label>
                        <input id="quote_form_productPrice_input" name="product_price" type="text" readonly value="' . number_format($product_price, 2) . '">
                        <p id="quote_form_unit">$/gallon</p><br>
                        <p id="quote_form_text">(Tax is included.)</p>
                        <input id="quote_form_quality_input" name="product_quantity" type="number" min="1" value="1" required>
                        <button id="form_button" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>';
                echo $html;
            }
        }
    } catch (PDOException $error) {
        echo $error;
    }
}

/**Get quotes for index page*/
function index_Quote()
{
    require_once 'connect.php';
    echo '<h2 style="background-color: rgb(91, 253, 91); margin: 0em; padding: 0.5em; text-align: center;">Quotes</h2>';
    try {
        $sql = "SELECT * FROM products";
        $statement = $conn->query($sql);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($results) {
            foreach ($results as $result) {
                $product_name = $result['product_name'];
                $product_price = $result['product_price'];
                $product_id = $result['product_id'];
                $product_price = price_Calculator($product_price, 100);
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
        echo $error;
    }
}