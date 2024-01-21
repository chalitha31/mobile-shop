<?php
session_start();
require "connection.php";
if (!isset($_GET["name"])) {
    echo "Please Enter Verification Code";
} else {
    $code = $_GET["name"];


    $rs = Database::search("SELECT * FROM `admin` WHERE `code` = '" . $code . "' ");
    if ($rs->num_rows == 1) {
        $admin_data = $rs->fetch_assoc();
        $_SESSION["a"] = $admin_data;
        echo "success";
    } else {
        echo "Invalid Code";
    }
}
