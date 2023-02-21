<?php
session_start();
require 'connect.php';
$name = '#';
$address1 = '#';
$address2 = '#';
$city = '#';
$state = '#';
$zipcode = '#';
error_reporting(0);
try {
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM user_profiles WHERE userid LIKE '$userid'";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $name = $result['name'];
            $address1 = $result['address1'];
            if ($result['address2'] == '0') {
                $address2 = '';
            } else {
                $address2 = $result['address2'];
            }
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
    <link rel="stylesheet" href="CSS/dashboard.css">
    <link rel="stylesheet" href="CSS/shipping_infor.css">
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

            <div class="vertical-menu">
                <a href="dashboard.php">Home</a>
                <a href="Cart.php" class="active">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php">Orders</a>
                <a href="profile.php">Profile</a>
                <a href="logout_action.php">Log Out</a>
            </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Shipping Information</h2>
            <form action="order_review.php" method="POST">
                <section><label id="label" for="name">Full Name</label>
                    <input id="input" name="name" type="text" value="<?php echo $name ?>" readonly='readonly'>
                </section>
                <section><label id="label" for=" address1">Address</label>
                    <input id="input" name="address" type="text" value="<?php echo $address1 ?>" readonly='readonly'>
                </section>
                <section><label id="label" for="city">City</label>
                    <input id="input" name="city" type="text" style="width: 120px;" value="<?php echo $city ?>"
                        readonly='readonly'>
                    <label id="label" for="state">State</label>
                    <input id="input" name="state" style="width: 80px;" type="text" value="<?php echo $state ?>"
                        readonly='readonly'>
                    <label id="label" for="zipcode">Zipcode</label>
                    <input id="input" name="zipcode" style="width: 80px;" maxlength="5" type="number"
                        value="<?php echo $zipcode ?>" readonly='readonly'>
                </section>
                <section><label id="label" for=" date">Delivery Date </label>
                    <input id="date" name="date" type="date" min="<?php echo date('Y-m-d'); ?>" required>
                </section>
                <section>
                    <button style="float:left" onclick="document.location='cart.php'">Back</button>
                    <button type="submit" name="place_order_button">Review Order</button>
                </section>
            </form>
        </div>
    </section>
</body>
<footer>
</footer>

</html>