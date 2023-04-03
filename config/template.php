<?php
error_reporting(0);
session_start();

/**head of website */
$head = '<title>ABC Company</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/clock.js"></script>
<script src="js/confirm.js"></script>
<link rel="stylesheet" href="CSS/frame.css">';

/**login form */
$loginForm = '<form id="login_form" action="functions.php" method="POST">
<h2 id="login_h2">Login</h2>
<label id="login_label" for="userName"><b>User Name:</b></label>
<input id="login_input" type="text" name="username" required><br>
<label id="login_label" for="password"><b>Password:</b></label>
<input id="login_input" type="password" name="password" required><br>
<button id="login_button" type="submit" name="loginButton"><b>Login</b></button><br>
<a id="login_a" href="forgetpassword.php">Forget password?</a>
</form>';

/**menu bar */
function menu($activePage)
{
    if ($activePage == 'dash_board') {
        $html = '<div style="text-align:center; padding: 5px;"><label for="name">
                    <h3><b>Welcome:</b>
                    </label>' . $_SESSION['cus_name'] . '</h3>
                </div>
                <div class=" vertical-menu">
                    <a href="dashboard.php" class="active">Home</a>
                    <a href="cart.php">Cart (' . $_SESSION['numberOfOrder'] . ')</a>
                    <a href="orders.php">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a onclick="showConfirm()">Log Out</a>
                </div>';
    } else if ($activePage == 'cart') {
        $html = '<div style="text-align:center; padding: 5px;"><label for="name">
                    <h3><b>Welcome:</b>
                    </label>' . $_SESSION['cus_name'] . '</h3>
                </div>
                <div class=" vertical-menu">
                    <a href="dashboard.php">Home</a>
                    <a href="cart.php" class="active">Cart (' . $_SESSION['numberOfOrder'] . ')</a>
                    <a href="orders.php">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a onclick="showConfirm()">Log Out</a>
                </div>';
    } else if ($activePage == 'order') {
        $html = '<div style="text-align:center; padding: 5px;"><label for="name">
                    <h3><b>Welcome:</b>
                    </label>' . $_SESSION['cus_name'] . '</h3>
                </div>
                <div class=" vertical-menu">
                    <a href="dashboard.php">Home</a>
                    <a href="cart.php" >Cart (' . $_SESSION['numberOfOrder'] . ')</a>
                    <a href="orders.php"class="active">Orders</a>
                    <a href="profile.php">Profile</a>
                    <a onclick="showConfirm()">Log Out</a>
                </div>';
    } else if ($activePage == 'profile') {
        $html = '<div style="text-align:center; padding: 5px;"><label for="name">
                    <h3><b>Welcome:</b>
                    </label>' . $_SESSION['cus_name'] . '</h3>
                </div>
                <div class=" vertical-menu">
                    <a href="dashboard.php">Home</a>
                    <a href="cart.php">Cart (' . $_SESSION['numberOfOrder'] . ')</a>
                    <a href="orders.php">Orders</a>
                    <a href="profile.php"class="active">Profile</a>
                    <a onclick="showConfirm()">Log Out</a>
                </div>';
    }
    echo $html;
}

/**profile page */
function profile_form($para)
{
    if ($para == 'profile') {
        $html = '<h2 style="text-align: center;">Profile</h2>
                <form id="profile_form" style="padding: 10px; text-align: center;" action="functions.php" method="POST">
                    <label for="name">Full Name:</label><input id="profile_input_field" name="name" type="text" value="' . $_SESSION['cus_name'] . '" required><br>
                    <label for="address1">Address #1</label><input id="profile_input_field" name="address1" type="text" value="' . $_SESSION['cus_add1'] . '" required><br>
                    <label for="address2">Address #2</label><input id="profile_input_field" name="address2" type="text" value="' . $_SESSION['cus_add2'] . '"><br>
                    <label for="city">City</label><input id="profile_input_field" name="city" type="text" style="width: 120px;" value="' . $_SESSION['cus_city'] . '" required>
                    <label for="state">State</label><input id="profile_input_field" name="state" style="width: 80px;" type="text" value="' . $_SESSION['cus_state'] . '" required>
                    <label for="zipcode">Zipcode</label><input id="profile_input_field" name="zipcode" style="width: 80px;" maxlength="5" type="number" value="' . $_SESSION['cus_zipcode'] . '" required>
                    <div style="text-align: center;"><button id="form_button" type="submit" name="pf_save_button">Save</button>
                    </div>
                </form>';
    } elseif ($para == 'filling') {
        $html = '<h4>Please create your profile before using our service!</h4>
        <form id="profile_form" style="padding: 10px; text-align: center;" action="functions.php" method="POST">
            <label for="name">Full Name:</label><input id="profile_input_field" name="name" type="text" required><br>
            <label for="address1">Address #1</label><input id="profile_input_field" name="address1" type="text" required><br>
            <label for="address2">Address #2</label><input id="profile_input_field" name="address2" type="text"><br>
            <label for="city">City</label><input id="profile_input_field" name="city" type="text" style="width: 120px;" required>
            <label for="state">State</label><input id="profile_input_field" name="state" style="width: 80px;" type="text" required>
            <label for="zipcode">Zipcode</label><input id="profile_input_field" name="zipcode" style="width: 80px;" maxlength="5" type="number" required>
            <div style="text-align: center;"><button id="form_button" style="height: 3.5em; width: 12em; border-radius: 2em;" type="submit" name="pf_submit_button">Save</button><a id="button_link" href="index.php">Exit</a>
            </div>
        </form>';
    } elseif ($para == 'ship_infor') {
        $html = '<h2 style="text-align: center;">Shipping Information</h2>
                <form id="profile_form" style="padding: 10px; text-align: center;" action="order_review.php" method="POST">
                    <label for="name">Full Name:</label><input id="profile_input_field" name="name" type="text" value="' . $_SESSION['cus_name'] . '" required><br>
                    <label for="address1">Address #1</label><input id="profile_input_field" name="address1" type="text" value="' . $_SESSION['cus_add1'] . '" required><br> <label for="city">City</label><input id="profile_input_field" name="city" type="text" style="width: 120px;" value="' . $_SESSION['cus_city'] . '" required>
                    <label for="state">State</label><input id="profile_input_field" name="state" style="width: 80px;" type="text" value="' . $_SESSION['cus_state'] . '" required>
                    <label for="zipcode">Zipcode</label><input id="profile_input_field" name="zipcode" style="width: 80px;" maxlength="5" type="number" value="' . $_SESSION['cus_zipcode'] . '" required><br>
                    <label id="label" for=" date">Delivery Date </label>
                    <input id="date" name="date" type="date" min="' . date('Y-m-d') . '" required>
                    <div style="margin: 1em;">
                        <button id="form_button" type="button" onclick="window.history.back();">Back</button>
                        <button id="form_button" type="submit" name="place_order_button">Review Order</button>
                    </div>
                </form>';
    }
    echo $html;
}
