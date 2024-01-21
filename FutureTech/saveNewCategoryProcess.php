<?php

require "connection.php";

if(isset($_POST["t"]) && isset($_POST["c"]) &&  isset($_POST["e"])){
  
    $vcode = $_POST["t"];
    $cname = $_POST["c"];
    $uemail = $_POST["e"];

  
    

   $admin_rs =  Database::search("SELECT * FROM `admin` WHERE `email` = '".$uemail."' ");
    if($admin_rs->num_rows == 1){
        $admin_data = $admin_rs->fetch_assoc();
        if($admin_data["code"] == $vcode){
            Database::iud("INSERT INTO `category`(`name`) VALUES('".$cname."')");
            echo "success";
        }else{
            echo "Invalid Verification Code";
        }
    }else{
        echo "Email Does Not Exist Again Pelase Try again";
    }

}

?>