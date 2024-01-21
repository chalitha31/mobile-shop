<?php

require "connection.php";

session_start();

if (isset($_SESSION["u"])) {

  $fname = $_POST["f"];
  $lname = $_POST["l"];
  $mobile = $_POST["m"];
  $addline1 = $_POST["a1"];
  $addline2 = $_POST["a2"];
  $city = $_POST["c"];
  $img = $_FILES["i"];


  if (empty($fname)) {
    echo "Please Enter Your First Name";
  } else if (strlen($fname) > 50) {
    echo "First Name Must Be Lesser Than 50 charackters";
  } else if (empty($lname)) {
    echo "Please Enter Your Last Name";
  } else if (strlen($lname) > 50) {
    echo "Last Name Must Be Lesser Than 50 charakters";
  } else if (strlen($mobile) != 10) {
    echo "Please Enter A Phone number which contains 10 integers";
  } else if (preg_match("/07[0,1,2,3,4,5,6,7,8][0-9]+/", $mobile == 0)) {
    echo "Please Enter A Valid Phone Number";
  } else if (empty($addline1)) {
    echo "Your AddressLine 1 Cannot be empty";
  } else if (empty($addline2)) {
    echo "Your AddressLine 2 Cannot be Empty";
  } else {


    if (isset($img)) {

      $allowd_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
      $fileex = $img["type"];
      //echo $fileex;

      if (!in_array($fileex, $allowd_image_extention)) {

        echo "Please Select A Valid Image";
      } else {

        $newimageextention;
        if ($fileex == "image/jpg") {
          $newimageextention = ".jpg";
        } else if ($fileex = "image/jpeg") {
          $newimageextention = ".jpeg";
        } else if ($fileex = "image/png") {
          $newimageextention = ".png";
        } else if ($fileex = "image/svg") {
          $newimageextention = ".svg";
        }

        $file_name = "resources//profiles//" . uniqid() . $newimageextention;
        //   echo $file_name;
        move_uploaded_file($img["tmp_name"], $file_name);

        $profilers = Database::search("SELECT * FROM `profile_img`  WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
        $in = $profilers->num_rows;
        if ($in == 1) {

          Database::iud("UPDATE `profile_img` SET `code` = '" . $file_name . "' WHERE  `user_email`='" . $_SESSION["u"]["email"] . "' ");

          echo "Profile Image Updated Successfully ";
        } else {

          Database::iud("INSERT INTO `profile_img`(`code`,`user_email`) VALUES('" . $file_name . "','" . $_SESSION["u"]["email"] . "') ");

          echo "Profile Image Saved Successfully ";
        }
      }
    }

    Database::iud("UPDATE `user` SET `fname` = '" . $fname . "',`lname` = '" . $lname . "', `mobile` = '" . $mobile . "' WHERE `email` = '" . $_SESSION["u"]["email"] . "' ");
    $_SESSION["u"]["fname"] = $fname;
    $_SESSION["u"]["lname"] = $lname;
    $_SESSION["u"]["mobile"] = $mobile;
    echo "User Has Been Updated";
    $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
    $nrs = $address->num_rows;

    if ($nrs == 1) {
      echo $city;
      Database::iud("UPDATE `user_has_address` SET `line1` = '" . $addline1 . "',`line2` = '" . $addline2 . "',`city_id`='" . $city . "' WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' ");
      echo "Address Added Successfuly";
    } else {

      Database::iud("INSERT INTO `user_has_address`(`user_email`,`line1`,`line2`,`city_id`) VALUES('" . $_SESSION["u"]["email"] . "','" . $addline1 . "','" . $addline2 . "','" . $city . "')");

      echo "New Address Address Successfuly. ";
    }
  }
} else {

  echo "error";
}
