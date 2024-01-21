<?php
require "connection.php";
session_start();
$user = $_SESSION["a"]["email"];
$id = $_POST["id"];
$isValid = Database::search("SELECT * FROM `product` WHERE `id` = '".$id."' AND `user_email` = '".$user."' ");
if($isValid->num_rows == 1){
    
    Database::iud("UPDATE `product` SET `removed` = '1' WHERE `id` = '".$id."' AND `user_email` = '".$user."' ");
    echo "success";

}else{
    echo "Error Please Try Reloading or logout login";
}
