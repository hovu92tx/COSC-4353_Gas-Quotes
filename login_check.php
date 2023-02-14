<?php
session_start();
require 'connect.php';
try {
    if (isset($_POST["login_button"])) {

        if (!empty($_POST['username'] && !empty($_POST['password']))) {
            $uname = $_POST['username'];
            $pass = $_POST['password'];
            $sql = "SELECT * FROM users WHERE username LIKE '$uname' and userpassword LIKE '$pass'";
            $statement = $conn->query($sql);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                foreach ($results as $result) {
                    $_SESSION['login_status'] = 'logged';
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['user_id'] = $result['user_id'];
                    if ($result['type'] === 0) {
                        $_SESSION['home'] = 'add_dash.php';
                        $_SESSION['usertype'] = 'Addmin';
                    } elseif ($result['type'] === 1) {
                        $_SESSION['home'] = 'cus_dash.php';
                        $_SESSION['usertype'] = 'Member';
                    }
                }
                header('location: profile_filling_page.php');
            } else {
                echo ("<script LANGUAGE='JavaScript'>window.alert('Login Fail! Please Login again');window.location.href='http://localhost/COSC-4353_Group-Project-/login.php';</script>");
            }
        }
    }
} catch (PDOException $error) {
    echo $error;
}