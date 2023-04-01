<?php
session_start();
require 'connect.php';
include 'config/template.php';
error_reporting(0);
?>
<!DOCTYPE html>
<html>

<head>
    <?php echo $head ?>
</head>

<body>
    <header>
        ABC Company
    </header>
    <aside>
        <div style="text-align:center; padding: 5px;"><label for=" name">
                <h3><b>Welcome:</b>
            </label><?php echo $_SESSION['cus_name'] ?></h3>
        </div>

        <div class="vertical-menu">
            <a href="dashboard.php">Home</a>
            <a href="Cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
            <a href="orders.php">Orders</a>
            <a href="profile.php" class="active">Profile</a>
            <a onclick="showConfirm()">Log Out</a>
        </div>
    </aside>
    <section>
        <h2 style="text-align: center;">Profile</h2>
        <form id="profile_form" style="padding: 10px; text-align: center;" action="profile_filling_action.php" method="POST">
            <label for="name">Full Name:</label><input id="profile_input_field" name="name" type="text" value="<?php echo $_SESSION['cus_name'] ?>" required><br>
            <label for="address1">Address #1</label><input id="profile_input_field" name="address1" type="text" value="<?php echo $_SESSION['cus_add1'] ?>" required><br>
            <label for="address2">Address #2</label><input id="profile_input_field" name="address2" type="text" value="<?php echo $_SESSION['cus_add2'] ?>"><br>
            <label for="city">City</label><input id="profile_input_field" name="city" type="text" style="width: 120px;" value="<?php echo $_SESSION['cus_city'] ?>" required>
            <label for="state">State</label><input id="profile_input_field" name="state" style="width: 80px;" type="text" value="<?php echo $_SESSION['cus_state'] ?>" required>
            <label for="zipcode">Zipcode</label><input id="profile_input_field" name="zipcode" style="width: 80px;" maxlength="5" type="number" value="<?php echo $_SESSION['cus_zipcode'] ?>" required>
            <div style="text-align: center;"><button id="form_button" type="submit" name="pf_submit_button">Save</button>
            </div>
        </form>
    </section>

</body>
<footer>
</footer>

</html>