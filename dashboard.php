<?php
session_start();
require 'connect.php';
error_reporting(0);
date_default_timezone_set('America/Chicago');
$userid = $_SESSION['userid'];
$name = "#";

try {

    $sql = "SELECT * FROM user_profiles WHERE userid LIKE '$userid'";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $name = $result['name'];
        }
    }
} catch (PDOException $error) {
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
    <link rel="stylesheet" href="CSS/dashboard_sup.css">
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
            <div class=" vertical-menu">
                <a href="dashboard.php" class="active">Home</a>
                <a href="cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php">Orders</a>
                <a href="profile.php">Profile</a>
                <a href="logout_action.php">Log Out</a>
            </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Prices of gas in <?php echo $_SESSION['location'] ?></h2>
            <div style=" text-align: center; margin: 10px;">
                <span id='ct7'></span>
            </div>
            <div style="margin: auto; width: 98%;  background-color: lightgreen; text-align: center;">
                <?php
                echo $_SESSION['mess'];
                $_SESSION['mess'] = '';
                ?>
            </div>
            <?php
            try {
                $sql2 = "SELECT * FROM products";
                $statement2 = $conn->query($sql2);
                $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                if ($results2) {
                    foreach ($results2 as $result2) {
                        $product_name = $result2['product_name'];
                        $product_price = $result2['product_price'];
                        $product_id = $result2['product_id'];
                        $html = '<form action="cart_function.php" method="POST"><input id="product_id" name="product_id" type="text" value="' . $product_id . '" readonly="readonly"></input><h4>' . $product_name . '</h4>
                                <p>Price: $' . $product_price . '/Gallon</p><div id="buying"><a style="margin-right: 5px;">Gallon  </a><input id="gallon" name="quantity"  type="number" value="1" min="1"></input><button name="add_to_cart">Add to Cart</button></div></form>';
                        echo $html;
                    }
                }
            } catch (PDOException $error) {
                echo 'Connection fail!';
            }
            ?>
            <div style="width:90%; margin: auto; clear: both;">
                <ul>
                    <li><a href="cart.php">Go To Cart</a></li>
                </ul>
            </div>
        </div>
    </section>


</body>
<footer>
</footer>

</html>