<?php
session_start();
/** Connect to the database */
require 'connect.php';
include 'config/sessions.php';
error_reporting(0);
/**This code recieve and verify the input data from login form*/
try {
    if (isset($_POST["loginButton"])) {

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $uname = $_POST['username'];
            $pass = $_POST['password'];
            /**Check whether the username exist in the database or not*/
            $sql = "SELECT * FROM users WHERE username LIKE '$uname'";
            $statement = $conn->query($sql);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                foreach ($results as $result) {
                    $username = $result['username'];
                    /** If the usename exist in the database, check password*/
                    $sql2 = "SELECT * FROM users WHERE username LIKE '$username' and password LIKE '$pass'";
                    $statement = $conn->query($sql2);
                    $results2 = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($results2) {
                        foreach ($results2 as $result2) {
                            $user_id = $result2['userid'];
                            /**Check user's information after check username and password */
                            $sql3 = "SELECT * FROM user_profiles WHERE userid LIKE '$user_id'";
                            $statement = $conn->query($sql3);
                            $results3 = $statement->fetchAll(PDO::FETCH_ASSOC);
                            if ($results3) {
                                foreach ($results3 as $result3) {
                                    if ($result3['name'] === '0' | $result3['address1'] === '0' | $result3['city'] === '0' | $result3['state'] === '0' | $result3['zipcode'] === '0') {
                                        $_SESSION['username'] = $result['username'];
                                        $_SESSION['userid'] = $result2['userid'];
                                        /**Ask customer to provide customer's information for the first time login */
                                        header('location: profile_filling_page.php');
                                    } else {
                                        $_SESSION['username'] = $result['username'];
                                        $_SESSION['userid'] = $result2['userid'];
                                        $_SESSION['cus_name'] = $result3['name'];
                                        $_SESSION['cus_add1'] = $result3['address1'];
                                        $_SESSION['cus_add2'] = $result3['address2'];
                                        $_SESSION['cus_city'] = $result3['city'];
                                        $_SESSION['cus_state'] = $result3['state'];
                                        $_SESSION['cus_zipcode'] = $result3['zipcode'];
                                        /**Go to customer dashboard for old customer */
                                        header('location: dashboard.php');
                                    }
                                }
                            }
                        }
                    } else {
                        /**Pop-up message if password is incorrect */
                        echo ("<script LANGUAGE='JavaScript'>alert('Login Fail! Please Login again');window.location.href='http://localhost/COSC-4353_Group-Project-/index.php';</script>");
                    }
                }
            } else {
                /**Create new username, password, and null profile if customer does not exist in the database then ask customer for customer's information */
                $sql4 = "INSERT INTO `users` (`userid`, `username`, `password`) VALUES (NULL, '$uname', '$pass')";
                $conn->query($sql4);
                $sql5 = "SELECT * FROM users WHERE username LIKE '$uname'";
                $statement = $conn->query($sql5);
                $results5 = $statement->fetchAll(PDO::FETCH_ASSOC);
                if ($results5) {
                    foreach ($results5 as $result5) {
                        $user_id = $result5['userid'];
                        $sql6 = "INSERT INTO `user_profiles` (`userid`, `name`, `address1`, `address2`, `city`, `state`, `zipcode`) VALUES ('$user_id', '0', '0', '0', '0', '0', '0')";
                        $conn->query($sql6);
                        $_SESSION['username'] = $uname;
                        $_SESSION['userid'] = $user_id;
                        header('location: profile_filling_page.php');
                    }
                }
            }
        }
    }
} catch (PDOException $error) {
    echo $error;
}
