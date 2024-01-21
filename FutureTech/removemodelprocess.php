<?php

require "connection.php";

$id = $_GET["id"];

$res = Database::search("SELECT * from `product` where `model` = '" . $id . "' ");
if ($res->num_rows >= 1) {

    echo "There is a products in this Model, so it cannot be removed!!";
} else {

    Database::iud("Delete from `model` where `id` = '$id'");

    echo "Success";
}
