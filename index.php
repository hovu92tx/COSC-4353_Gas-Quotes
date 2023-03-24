<?php
session_start();
require('connect.php');
$_SESSION['username'] = '';
$_SESSION['userid'] = '';
$_SESSION['cus_name'] = "#";
$_SESSION['cus_add1'] = "#";
$_SESSION['cus_add2'] = "#";
$_SESSION['cus_city'] = "#";
$_SESSION['cus_state'] = "#";
$_SESSION['cus_zipcode'] = "#";
$_SESSION['numberOfOrder'] = 0;
$_SESSION['cart'] = array();
$_SESSION['mess'] = '';
$_SESSION['delivery_date'] = '';
$_SESSION['order_total'] = 0;
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
    <title>ABC Company</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <section id="section1">
        <div id="left_box">
            <form action="login_check.php" method="POST">
                <h2>Login</h2>
                <div style="text-align: right; margin-right: 70px ;">
                    <label for="username" style="margin-right: 10px;"><b>User name</b></label><input id="login_input"
                        type="text" placeholder="User Name" name="username" maxlength="50" require>
                    <br>
                    <label for="password" style="margin-right: 10px;"><b>Password</b></label><input id="login_input"
                        type="password" placeholder="Password" name="password" maxlength="50" required>
                </div>

                <div id="login_button"><button type="submit" name="login_button">Submit</button></div>
                <div id="forget_pass_link"><a href="forgetpassword.php">Forget password?</a></div>
            </form>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Quotes</h2>
            <?php
            try {
                $sql = "SELECT * FROM products";
                $statement = $conn->query($sql);
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                if ($results) {
                    foreach ($results as $result) {
                        $product_name = $result['product_name'];
                        $product_price = $result['product_price'];
                        $product_id = $result['product_id'];
                        $html = '<div id="quote_form"><h4>' . $product_name . '</h4>
                                <p>Price: $' . $product_price . '/Gallon</p></div>';
                        echo $html;
                    }
                }
            } catch (PDOException $error) {
                echo "Server Error";
            }
            ?>
        </div>
    </section>
</body>
<footer>
</footer>

</html>