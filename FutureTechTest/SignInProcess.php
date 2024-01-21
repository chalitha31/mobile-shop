<?php

session_start();

require "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rememberMe"];  //true/falses

if (empty($email)) {
    echo "Please enter your email";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email Address";
} else if (empty($password)) {
    echo "Please enter your password";
} else {

    $hash = hash("sha256", $password);

    $resultset = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' AND `password` = '" . $hash . "'");
    $n = $resultset->num_rows;

    if ($n == 1) {


        echo "success";

        $d = $resultset->fetch_assoc();

        $storeHash = $d["password"];

        if ($hash === $storeHash) {

            $_SESSION["u"] = $d;

            if ($rememberMe == "true") {
                setcookie("email", $email, time() + (60 * 60 * 24 * 365));
                setcookie("password", $password, time() + (60 * 60 * 24 * 365));
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
        } else {
            echo "Please Check your Password";
            exit();
        }
    } else {

        echo "Invalid Email Or Password";
    }
}
