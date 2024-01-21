<?php
session_start();
require 'connection.php';

$color = $_POST["clr"];
$title = $_POST["t"];
$quantity = $_POST["qty"];
$price = $_POST["c"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
$imageCount = $_POST["imageCount"];
$prodcutid = $_SESSION['p']['id'];
$condition = $_POST["con"];



if (empty($title)) {
    echo "please Enter a title to your product";
} else if (strlen($title) > 100) {
    echo "Please Enter A title that contains 100 charackters or lower";
} else if (empty($quantity)) {
    echo "Quantity field Mus Not Be Empty";
} else if ($quantity == "0" || $quantity < 0 || $quantity == "e") {
    echo "Please Enter A valid Quantity";
} else if ($price  == "0" || $price < 0 || $price == "e") {
    echo "Please Enter A Valid Price ";
} else if (empty($dwc)) {
    echo "Please Enter Delivery Cost in Colombo";
} else if (empty($doc)) {
    echo "Please Enter Delivery Cost out of Colombo";
} else if (is_int($price)) {
    echo "Please Enter A Valid Price";
} else if (is_int($dwc)) {
    echo "Please Enter A valid Price For Delivery in Colombo";
} else if (is_int($dwc)) {
    echo "Please Enter A valid Price For Delivery out of Colombo";
} else {

    if ($imageCount != 0) {
        $allowed_image_extentions = array("image/jpeg", "image/jpg", "image/png", "image/svg");
        for ($i = 1; $i <= $imageCount; $i++) {
            $image = $_FILES["img" . $i];
            $file_extention = $image["type"];
            if (!in_array($file_extention, $allowed_image_extentions)) {
                $isImgValid = "no";
            }
        }


        if (isset($isImgValid)) {
            echo "Selected product Image/Images Not Valid";
        } else {

            Database::iud("UPDATE product SET `title` = '" . $title . "', `qty`='" . $quantity . "', `price`='" . $price . "',`description`='" . $desc . "', `delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',`colour_id` = '" . $color . "',`condition_id` = '" . $condition . "' WHERE `id`='" . $prodcutid . "' ");
            echo 'success';


            $img_c = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $prodcutid . "'");

            if ($img_c->num_rows == 0) {
                echo "Error On Product Image";
            } else {

                Database::iud("DELETE FROM `images` WHERE `product_id`='" . $prodcutid . "' ");
                for ($i = 1; $i <= $imageCount; $i++) {
                    $image = $_FILES["img" . $i];
                    $fileName = "resources//products//" . uniqid() . $image["name"];
                    move_uploaded_file($image["tmp_name"], $fileName);
                    Database::iud("INSERT INTO `images`(`code`,`product_id`) VALUES ('" . $fileName . "','" . $prodcutid . "') ");
                }
            }
        }
    } else {
        Database::iud("UPDATE product SET `title` = '" . $title . "', `qty`='" . $quantity . "', `price`='" . $price . "',`description`='" . $desc . "', `delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',`colour_id` = '" . $color . "',`condition_id` = '" . $condition . "' WHERE `id`='" . $prodcutid . "' ");
        echo 'success';
    }
}
