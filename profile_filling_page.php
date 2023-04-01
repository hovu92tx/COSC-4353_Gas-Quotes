<?php
session_start();
include 'config/template.php';
$_SESSION['login_status'] = '0';
$_SESSION['username'] = '';
$_SESSION['user_id'] = '';
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
    <aside style="width: 10%; border: none;"></aside>
    <section>
        <h4>Please create your profile before using our service!</h4>
        <form id="profile_form" style="padding: 10px; text-align: center;" action="profile_filling_action.php" method="POST">
            <label for="name">Full Name:</label><input id="profile_input_field" name="name" type="text" required><br>
            <label for="address1">Address #1</label><input id="profile_input_field" name="address1" type="text" required><br>
            <label for="address2">Address #2</label><input id="profile_input_field" name="address2" type="text"><br>
            <label for="city">City</label><input id="profile_input_field" name="city" type="text" style="width: 120px;" required>
            <label for="state">State</label><input id="profile_input_field" name="state" style="width: 80px;" type="text" required>
            <label for="zipcode">Zipcode</label><input id="profile_input_field" name="zipcode" style="width: 80px;" maxlength="5" type="number" required>
            <div style="text-align: center;"><button id="form_button" style="height: 3.5em; width: 12em; border-radius: 2em;" type="submit" name="pf_submit_button">Save</button><a id="button_link" href="index.php">Exit</a>
            </div>
        </form>
    </section>
</body>
<footer>
</footer>

</html>