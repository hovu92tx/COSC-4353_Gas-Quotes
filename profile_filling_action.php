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
 
