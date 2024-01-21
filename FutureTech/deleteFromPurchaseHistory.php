<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {
    $id = $_GET["id"];
    $rs =  Database::search("SELECT * FROM `invoice` WHERE `id` = '" . $id . "' ");
    $rsn = $rs->num_rows;
    if($rsn == 1){
       Database::iud("UPDATE `invoice` SET `hidden` = '1' WHERE `id` = '".$id."' ");

      echo "success";
    }else{
        echo "An Error Occured Please Try refreshing the brower";
    }
}
