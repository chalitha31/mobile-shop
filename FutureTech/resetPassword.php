<?php
 
 require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp= $_POST["rnp"];
$vc = $_POST["vc"];


if(empty($e)){
   echo "Missing Email Address";
}else if(empty($np)){
   echo "Please Enter Your new Password";
}else if(strlen($np)< 5 || strlen($np)>= 20){
 echo "password Length should be between 5 to 20.";   
}else if(empty($rnp)){
    echo "Please Re- Enter Your New Password";
}else if($np != $rnp){
     echo "Password & Re-type Password Does Not Match";
}else if(empty($vc)){
   echo "Please Enter Your Verification code.";
}else {
   $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' AND `verification_code` ='".$vc."'");
   if($rs->num_rows == 1){
     
     Database::iud("UPDATE `user` SET `password` = '".$np."' WHERE `email` = '".$e."' ");
  echo "success";
   }else{
       echo "Password Reset Failed";
   }
}

?>