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
    <link rel="stylesheet" href="CSS/cart.css">
    <script src="clock.js"></script>
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
            echo '<div style= "text-align: center;" ><p>Cart is empty!</p></div>';
            ?>
        </div>
    </section>

</body>
<footer>
</footer>

</html>