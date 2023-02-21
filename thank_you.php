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
    <link rel="stylesheet" href="CSS/thank_you.css">
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
            <h2 style="text-align: center;">Thank you for your order!</h2>
            <div style="width:90%; margin: auto;">
                <ul>
                    <li><a href="dashboard.php">Continue Shopping</a></li>
                </ul>
            </div>
        </div>


    </section>
</body>
<footer>
</footer>

</html>