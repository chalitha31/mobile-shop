<?php
session_start();
if (isset($_SESSION["u"])) {
    require "connection.php";
    $id = $_POST["pid"];
    $qty = $_POST["pqty"];
    $price = $_POST["uprice"];
    if (!preg_match("/(0|0[.]|0[.][0-9]*)|[1-9]|[1-9][0-9]*|[1-9][0-9]*[.]|[1-9][0-9]*[.][0-9]*/", $price)) {
        echo "invalid price";
    } else if (!preg_match("/[1-9][0-9]*/", $qty)) {
        echo "invalid qty";
    } else {
        $rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "' AND `qty` >= '" . $qty . "' AND `price` = '" . $price . "' ");
        $rs2 = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
        $rsn = $rs->num_rows;
        $rsn2 = $rs2->num_rows;
        if ($rsn == 1 && $rsn2 == 1) {
            $_SESSION["buy"]["id"] = $id;
            $_SESSION["buy"]["qty"] = $qty;
            $data = $rs2->fetch_assoc();
            $data2 = $rs->fetch_assoc();
            if ($data["city_id"] == "4") {

                $_SESSION["buy"]["shipping"] = $data2["delivery_fee_colombo"];
            } else {
                $_SESSION["buy"]["shipping"] = $data2["delivery_fee_other"];
            }

            echo "product Ok";
        } else if ($rsn == 1 && $rsn2 != 1) {
            echo "profile not updated";
        } else {
            echo "error";
        }
    }
} else {
    echo "user not signed in";
}
