<?php

require "connection.php";
session_start();
if(isset($_SESSION["a"])){
    $id = $_GET["id"]; 

    $rs = Database::search("SELECT * FROM `product` WHERE `id` = '".$id."' ");
    if($rs->num_rows == 1){
        $data = $rs->fetch_assoc();
        if($data["blocked"] == '1' ){
           Database::iud("UPDATE `product` SET `blocked` = '0'  WHERE `id` = '".$id."' ");
           echo "Product Unblocked";
        }else if($data["blocked"] == '0'){
            Database::iud("UPDATE `product` SET `blocked` = '1' WHERE `id` = '".$id."' ");
            echo "Product Blocked";
        }
       
    }else{
        echo "Error Please Try Again";
    }
}else{
    echo "Please Sign In as A Admin";
}

?>