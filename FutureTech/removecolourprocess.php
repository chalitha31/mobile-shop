<?php

require "connection.php";

$id = $_GET["id"];

$res = Database::search("SELECT * from `product` where `colour_id` = '" . $id . "' ");
if ($res->num_rows >= 1) {

    echo "There is a products in this Colour, so it cannot be removed!!";
} else {

    Database::iud("Delete from `colour` where `id` = '$id'");

    echo "Success";
}
