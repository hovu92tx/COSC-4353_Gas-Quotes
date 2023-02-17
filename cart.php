<?php
session_start();
require 'connect.php';
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
    <link rel="stylesheet" href="CSS/cart.css">
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
                <div style=" text-align: center; margin: 10px;">
                    <?php echo $_SESSION['date']; ?>
                </div>
                <div class="vertical-menu">
                    <a href="dashboard.php">Home</a>

                    <a href="cart.php" class="active">Cart</a>
                    <a href="orders.php">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a href="logout_action.php">Log Out</a>
                </div>
        </div>
        </form>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Cart</h2>
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
                                <p>Price: ' . $product_price . '/Galon</p><button>Add to Cart</button></div>';
                        echo $html;
                    }
                }
            } catch (PDOException $error) {
                echo $error;
            }
            ?>
        </div>
    </section>

</body>
<footer>
</footer>

</html>