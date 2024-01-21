<?php

require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$Rpassword = $_POST["Rpassword"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];



if (empty($fname)) {
    echo "Please enter your first name";
} else if (strlen($fname) > 30) {
    echo "first name must be less than 30 characters";
} else if (empty($lname)) {
    echo "Please enter your last name";
} else if (strlen($lname) > 30) {
    echo "last name must be less than 30 characters";
} else if (empty($email)) {
    echo "Please enter your email";
} else if (strlen($email) >= 100) {
    echo "Email must be less than 100 characters";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email Address";
} else if (empty($password)) {
    echo "Please enter your password";
} else if (strlen($password) <= 5 || strlen($password) >= 20) {
    echo "password length should be between 6 to 20";
} else if (empty($Rpassword)) {
    echo "Please enter your ReType-password";
} else if ($password != $Rpassword) {
    echo  "Password & Retype-password does not match";
} else if (empty($mobile)) {
    echo "please enter your mobile Number";
} else if (strlen($mobile) != 10) {
    echo "mobile number should contain 10 charachters";
} else if (preg_match("/07[0,1,2,4,5,6,7,8,][0-9]+/", $mobile) == 0) {
    echo "Invalid Mobile Number";
} else if ($gender == "Gender") {
    echo "Please Select your gender";
} else {

    $r = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");
    $n = $r->num_rows;
    $ep = $r->fetch_assoc();

    if ($n > 0) {

        if ($ep["email"] == $email) {

            echo "already used in this email. try again.";
        } else if ($ep["mobile"] == $mobile) {

            echo "already used in this Mobile Number. try again.";
        }

        // echo "User With the Same Email Address Or Mobile Number already exists";

    } else {

        $hash = hash("sha256", $password);

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`mobile`,`gender`,`password`,`register_date`) VALUES
      ('" . $fname . "', '" . $lname . "','" . $email . "','" . $mobile . "','" . $gender . "','" . $hash . "','" . $date . "')");

        echo "success";
    }
}
