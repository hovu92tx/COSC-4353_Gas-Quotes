<?php
session_start();
require 'connect.php';
try {
    if (isset($_POST["pf_submit_button"])) {
        if (!empty($_POST['name'] && $_POST['address1'] && $_POST['city'] && $_POST['state'] && $_POST['zipcode'])) {
            $user_id = $_SESSION['userid'];
            $name = $_POST['name'];
            $address1 = $_POST['address1'];
            if ($_POST['address2'] === '') {
                $address2 = '0';
           } else {
                $address2 = $_POST['address2'];
            }
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];
            $sql = "UPDATE `user_profiles` SET name= '$name', address1='$address1', address2= '$address2', city= '$city',state= '$state', zipcode= '$zipcode' WHERE userid ='$user_id'";
            $conn->query($sql);
            $_SESSION['loction'] = $city;
            header('location: dashboard.php');
        }
    }
} catch (PDOException $error) {
    echo $error;
} 
