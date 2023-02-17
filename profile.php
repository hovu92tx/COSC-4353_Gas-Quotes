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
    <link rel="stylesheet" href="CSS/profile.css">
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
            <div style=" text-align: center; margin: 10px;">
                <?php echo $_SESSION['date']; ?>
            </div>
            <div class="vertical-menu">
                <a href="dashboard.php">Home</a>
                <a href="Cart.php">Cart</a>
                <a href="orders.php">Orders</a>
                <a href="profile.php" class="active">Profile</a>
                <a href="logout_action.php">Log Out</a>
            </div>
        </div>
        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Profile</h2>
            <form style="padding: 10px;" action="profile_filling_action.php" method="POST">
                <label for="name">Full Name:</label><input id="input_field" name="name" type="text"
                    value="<?php echo $name ?>" required><br>
                <label for="address1">Address #1</label><input id="input_field" name="address1" type="text"
                    value="<?php echo $address1 ?>" required><br>
                <label for="address2">Address #2</label><input id="input_field" name="address2" type="text"
                    value="<?php echo $address2 ?>"><br>
                <label for="city">City</label><input id="input_field" name="city" type="text" style="width: 120px;"
                    value="<?php echo $city ?>" required>
                <label for="state">State</label><input id="input_field" name="state" style="width: 80px;" type="text"
                    value="<?php echo $state ?>" required>
                <label for="zipcode">Zipcode</label><input id="input_field" name="zipcode" style="width: 80px;"
                    maxlength="5" type="number" value="<?php echo $zipcode ?>" required>
                <div style="text-align: center;"><button type="submit" name="pf_submit_button">Save</button></div>
            </form>
        </div>
    </section>

</body>
<footer>
</footer>

</html>