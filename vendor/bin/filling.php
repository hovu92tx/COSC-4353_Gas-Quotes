<?php
function filling($page)
{
    require 'connect.php';
    if ($page == 'filling') {
        if (!empty($_POST['name'] && $_POST['address1'] && $_POST['city'] && $_POST['state'] && $_POST['zipcode'])) {
            $user_id = $_SESSION['userid'];
            $name = $_POST['name'];
            $address1 = $_POST['address1'];
            if ($_POST['address2'] === '') {
                $address2 = 'N/A';
            } else {
                $address2 = $_POST['address2'];
            }
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];
            $_SESSION['cus_name'] = $name;
            $_SESSION['cus_add1'] = $address1;
            $_SESSION['cus_add2'] = $address2;
            $_SESSION['cus_city'] = $city;
            $_SESSION['cus_state'] = $state;
            $_SESSION['cus_zipcode'] = $zipcode;
            $sql = "UPDATE `user_profiles` SET name= '$name', address1='$address1', address2= '$address2', city= '$city',state= '$state', zipcode= '$zipcode' WHERE userid ='$user_id'";
            $conn->query($sql);
        }
        header('location: dashboard.php');
    } elseif ($page == 'profile') {
        if (!empty($_POST['name'] && $_POST['address1'] && $_POST['city'] && $_POST['state'] && $_POST['zipcode'])) {
            $user_id = $_SESSION['userid'];
            $name = $_POST['name'];
            $address1 = $_POST['address1'];
            if ($_POST['address2'] === '') {
                $address2 = 'N/A';
            } else {
                $address2 = $_POST['address2'];
            }
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];
            $_SESSION['cus_name'] = $name;
            $_SESSION['cus_add1'] = $address1;
            $_SESSION['cus_add2'] = $address2;
            $_SESSION['cus_city'] = $city;
            $_SESSION['cus_state'] = $state;
            $_SESSION['cus_zipcode'] = $zipcode;
            $sql = "UPDATE `user_profiles` SET name= '$name', address1='$address1', address2= '$address2', city= '$city',state= '$state', zipcode= '$zipcode' WHERE userid ='$user_id'";
            $conn->query($sql);
        }
        header('location: profile.php');
    }
}
