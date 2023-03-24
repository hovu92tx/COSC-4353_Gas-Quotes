<?php
session_start();
require 'connect.php';
error_reporting(0);
try {
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM user_profiles WHERE userid LIKE $userid";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $address = $result['address1'];
            $city = $result['city'];
            $state = $result['state'];
            $zipcode = $result['zipcode'];
        }
    }
} catch (PDOException $error) {
    echo 'Connection fail!';
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
                <a href="Cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php" class="active">Orders</a>
                <a href="profile.php">Profile</a>
                <a href="logout_action.php">Log Out</a>
            </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Order History</h2>
            <div>
                <table>
                    <tr>
                        <th id="order_id">Order ID</th>
                        <th id="date">Date</th>
                        <th id="delivery_add">Delivery Address</th>
                        <th id="total">Total</th>
                        <th id="detail">Detail</th>
                        <th>Notes</th>
                    </tr>
                </table>
            </div>
            <?php
            try {
                $sql2 = "SELECT * FROM orders WHERE user_id LIKE $userid";
                $statement2 = $conn->query($sql2);
                $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                if ($results2) {
                    foreach ($results2 as $result2) {
                        $order_id = $result2['order_id'];
                        $order_date = $result2['order_date'];
                        $order_total = $result2['order_total'];
                        $html = '<form id="item" action="order_detail.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="order_id"><input id="infor" name="order_id" type="text" value="' . $order_id . ' "readonly="readonly"></input></th>
                                        <th id="date">' . $order_date . '</th>
                                        <th id="delivery_add">' . $address . ', ' . $city . ', ' . $state . ', ' . $zipcode . '</th>
                                        <th id="total"><input id="order_total" name="order_total" type="number" value="' . $order_total . '"readonly="readonly" ></input></th>
                                        <th id="detail"><button type="submit" name="detail_order">Order Detail</button></th>
                                        <th></th>
                                    </tr>
                                </table></form>';
                        echo $html;
                    }
                }
            } catch (PDOException $error) {
                echo 'Connection fail!';
            }

            ?>
        </div>


    </section>
</body>
<footer>
</footer>

</html>