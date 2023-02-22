<?php
session_start();
require 'connect.php';
error_reporting(0);

try {
    if (isset($_POST["login_button"])) {

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $uname = $_POST['username'];
            $pass = $_POST['password'];
            $sql = "SELECT * FROM users WHERE username LIKE '$uname'";
            $statement = $conn->query($sql);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                foreach ($results as $result) {
                    $username = $result['username'];
                    $sql2 = "SELECT * FROM users WHERE username LIKE '$username' and password LIKE '$pass'";
                    $statement = $conn->query($sql2);
                    $results2 = $statement->fetchAll(PDO::FETCH_ASSOC);
                    if ($results2) {
                        foreach ($results2 as $result2) {
                            $user_id = $result2['userid'];
                            $sql3 = "SELECT * FROM user_profiles WHERE userid LIKE '$user_id'";
                            $statement = $conn->query($sql3);
                            $results3 = $statement->fetchAll(PDO::FETCH_ASSOC);
                            if ($results3) {
                                foreach ($results3 as $result3) {
                                    if ($result3['name'] === '0' | $result3['address1'] === '0' | $result3['city'] === '0' | $result3['state'] === '0' | $result3['zipcode'] === '0') {
                                        $_SESSION['username'] = $result['username'];
                                        $_SESSION['userid'] = $result2['userid'];
                                        $_SESSION['login_status'] = '1';
                                        header('location: profile_filling_page.php');
                                    } else {
                                        $_SESSION['username'] = $result['username'];
                                        $_SESSION['userid'] = $result2['userid'];
                                        $_SESSION['login_status'] = '1';
                                        $_SESSION['location'] = $result3['city'];
                                        header('location: dashboard.php');
                                    }
                                }
                            } else {
                                $sql7 = "INSERT INTO `user_profiles` (`userid`, `name`, `address1`, `address2`, `city`, `state`, `zipcode`) VALUES ('$user_id', '0', '0', '0', '0', '0', '0')";
                                $conn->query($sql7);
                                $_SESSION['username'] = $result['username'];
                                $_SESSION['userid'] = $result2['userid'];
                                $_SESSION['login_status'] = '1';
                                header('location: profile_filling_page.php');
                            }
                        }
                    } else {
                        echo ("<script LANGUAGE='JavaScript'>window.alert('Login Fail! Please Login again');window.location.href='http://localhost/COSC-4353_Group-Project-/index.php';</script>");
                    }
                }
            } else {
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
                        $_SESSION['login_status'] = '1';
                        header('location: profile_filling_page.php');
                    }
                }
            }
        }
    }
} catch (PDOException $error) {
    echo $error;
}
