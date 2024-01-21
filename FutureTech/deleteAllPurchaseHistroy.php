<?php
require "connection.php";
session_start();
if(isset($_SESSION["u"])){
   
    Database::iud("UPDATE `invoice` SET `hidden` = '1' WHERE `user_email` = '".$_SESSION["u"]["email"]."' ");
    echo "success";
} 

?>