<?php
session_start();
require 'connect.php';
$name = "#";
error_reporting(0);
try {
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM user_profiles WHERE userid LIKE '$userid'";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $name = $result['name'];
            $address = $result['address1'];
            $city = $result['city'];
            $state = $result['state'];
            $zipcode = $result['zipcode'];
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
    <link rel="stylesheet" href="CSS/orders.css">
    <script src="confirm.js"></script>
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <section id="section1">
        <div id="left_box">
            <form style="text-align: left;" action="logout_action.php" method="POST">
                <div style="text-align:center; padding: 5px;"><label for=" name">
                        <h3><b>Welcome:</b>
                    </label><?php echo $name ?></h3>
                </div>
                <div class="vertical-menu">
                    <a href="dashboard.php">Home</a>
                    <a href="cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                    <a href="orders.php" class="active">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a onclick="showConfirm()">Log Out</a>
                </div>
        </div>
        </form>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Order History</h2>
            <?php
            try {
                $sql2 = "SELECT * FROM orders WHERE user_id LIKE $userid";
                $statement2 = $conn->query($sql2);
                $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                if ($results2) {
                    foreach ($results2 as $result2) {
                        $product_name = $result2['order_product_name'];
                        $product_price = $result2['order_unit_price'];
                        $product_id = $result2['order_product_id'];
                        $html = '<div id="quote_form"><h4>' . $product_name . '</h4>
                                <p>Price: ' . $product_price . '/Galon</p><button>Add to Cart</button></div>';
                        echo $html;
                    }
                } else {
                    echo '<div style= "text-align: center;" ><p>There was no order!</p></div>';
                }
            } catch (PDOException $error) {
                echo "Connection fail!";
            }
            ?>
        </div>
    </section>
</body>
<footer>
</footer>

</html>