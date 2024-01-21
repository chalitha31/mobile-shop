<?php

require "connection.php";

$id = $_GET["id"];

$res = Database::search("SELECT * from `product` where `category` = '" . $id . "' ");
if ($res->num_rows >= 1) {

    echo "There is a products in this category, so it cannot be removed!!";
} else {

    Database::iud("Delete from `category` where `id` = '$id'");

    echo "Success";
}
