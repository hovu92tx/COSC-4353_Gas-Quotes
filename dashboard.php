<?php
session_start();
require 'connect.php';
date_default_timezone_set('America/Chicago');
$date = date('m-d-y h:i:s');
$_SESSION['date'] = $date;
$userid = $_SESSION['userid'];
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
    echo $error;
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
                <a href="cart.php">Cart</a>
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
                        $html = '<div id="quote_form"><h4>' . $product_name . '</h4>
                                <p>Price: ' . $product_price . '/Galon</p><div id="buying"><a style="margin-right: 5px;">Number of Gallon  </a><input id="numberofgallon" type="number"></input><button>Add to Cart</button></div></div>';
                        echo $html;
                    }
                }
            } catch (PDOException $error) {
                echo 'Connection fail!';
            }
            ?>
        </div>
        </div>
    </section>

</body>
<footer>
</footer>

</html>