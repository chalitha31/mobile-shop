<?php
session_start();
if (isset($_SESSION["u"])) {
    require "connection.php";


    // $id = $_POST["pid"];
    // $qty = $_POST["pqty"];
    // $price = $_POST["uprice"];


    // if (!preg_match("/(0|0[.]|0[.][0-9]*)|[1-9]|[1-9][0-9]*|[1-9][0-9]*[.]|[1-9][0-9]*[.][0-9]*/", $price)) {
    //     echo "invalid price";
    // } else if (!preg_match("/[1-9][0-9]*/", $qty)) {
    //     echo "invalid qty";
    // } else {

    $cart = Database::search("SELECT * FROM `cart` WHERE  `user_email` = '" . $_SESSION["u"]["email"] . "'");
    $cartnum = $cart->num_rows;
    $_SESSION["num"] = 0;
    $_SESSION["buy"]["id"] = array();
    $_SESSION["buy"]["qty"] = array();

    $_SESSION["buy"]["shipping"] = 0;
    for ($y = 0; $y < $cartnum; $y++) {
        $cartdi = $cart->fetch_assoc();

        $_SESSION["num"] =  $_SESSION["num"] + 1;

        $rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cartdi["product_id"] . "' AND `qty` >= '" . $cartdi["qty"] . "' ");
        $rs2 = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
        $rsn = $rs->num_rows;
        $rsn2 = $rs2->num_rows;

        if ($rsn == 1 && $rsn2 == 1) {

            $_SESSION["buy"]["id" . $y] = $cartdi["product_id"];
            $_SESSION["buy"]["qty" . $y] = $cartdi["qty"];

            array_push($_SESSION["buy"]["id"], $cartdi["product_id"]);
            array_push($_SESSION["buy"]["qty"], $cartdi["qty"]);


            $data = $rs2->fetch_assoc();
            $data2 = $rs->fetch_assoc();
            if ($data["city_id"] == "4") {

                $_SESSION["buy"]["shipping"] = $data2["delivery_fee_colombo"];
            } else {
                $_SESSION["buy"]["shipping"] = $data2["delivery_fee_other"];
            }
        }
    }
    echo "product Ok";
}


// } else {
//     echo "user not signed in";
// }
