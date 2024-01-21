<?php

require "connection.php";
session_start();
if(isset($_SESSION["a"])){
    $id = $_GET["id"]; 
    
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$id."' ");
    if($rs->num_rows == 1){
        $data = $rs->fetch_assoc();
        if($data["blocked"] == '1' ){
           Database::iud("UPDATE `user` SET `blocked` = '0'  WHERE `email` = '".$id."' ");
           echo "User Unblocked";
        }else if($data["blocked"] == '0'){
            Database::iud("UPDATE `user` SET `blocked` = '1' WHERE `email` = '".$id."' ");
            echo "User Blocked";
        }
       
    }else{
        echo "Error Please Try Again";
    }
}else{
    echo "Please Sign In as A Admin";
}

?>