<?php
session_start();
require 'connect.php';
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
    <link rel="stylesheet" href="CSS/orders.css">
    <script src="confirm.js"></script>
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <section id="section1">
        <div id="left_box">
            <div style="text-align:center; padding: 5px;"><label for=" name">
                    <h3><b>Welcome:</b>
                </label><?php echo $_SESSION['cus_name'] ?></h3>
            </div>
            <div class="vertical-menu">
                <a href="dashboard.php">Home</a>
                <a href="Cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php" class="active">Orders</a>
                <a href="profile.php">Profile</a>
                <a onclick="showConfirm()">Log Out</a>
            </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Order History</h2>
            <div>
                <table>
                    <tr>
                        <th id="order_id">Order ID</th>
                        <th id="date">Date</th>
                        <th id="add">Delivery Address</th>
                        <th id="total">Total</th>
                        <th id="action">Actions</th>
                    </tr>
                </table>
            </div>
            <?php
            $userid = $_SESSION['userid'];
            $sql2 = "SELECT * FROM orders WHERE user_id LIKE $userid";
            $statement2 = $conn->query($sql2);
            $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results2 as $result2) {
                $order_id = $result2['order_id'];
                $order_date = $result2['order_date'];
                $order_total = $result2['order_total'];
                $html = '<form id="item" action="order_detail.php" method="POST">
                                <table>
                                    <tr>
                                        <th id="order_id"><input id="infor" name="order_id" type="text" value="' . $order_id . ' "readonly="readonly"></input></th>
                                        <th id="date">' . date('m-d-Y', strtotime($order_date)) . '</th>
                                        <th id="add">' . $_SESSION['cus_add1'] . ', ' . $_SESSION['cus_city'] . ', ' . $_SESSION['cus_state'] . ', ' . $_SESSION['cus_zipcode'] . '</th>
                                        <th id="total">$' . number_format($order_total, 2) . '</th>
                                        <th id="action"><button type="submit" name="order_detail">Order Detail</button></th>
                                    </tr>
                                </table></form>';
                echo $html;
            }
            ?>
        </div>


    </section>
</body>
<footer>
</footer>

</html>