<?php

require "connection.php";

$id = $_GET["id"];

$res = Database::search("SELECT * from `product` where `brand` = '" . $id . "' ");
if ($res->num_rows >= 1) {

    echo "There is a products in this brand, so it cannot be removed!!";
} else {

    Database::iud("Delete from `brand` where `id` = '$id'");

    echo "Success";
}
